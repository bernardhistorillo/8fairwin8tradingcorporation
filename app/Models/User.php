<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function gemPurchases() {
        return $this->hasMany(GemPurchase::class);
    }

    public function orders() {
        return $this->hasMany(Order::class);
    }

    public function ordersAsATerminal() {
        return $this->hasMany(Order::class, 'terminal_user_id');
    }

    public function rankPoints() {
        return $this->hasMany(RankPoint::class);
    }

    public function fullName() {
        return $this->firstname . ' ' . $this->lastname;
    }

    public function packageAndRank() {
        $packages = ["", "DBP", "DSP",  "FDP", "DMP"];
        $ranks = array("Free Account", "Dealer", "Explorer", "Pathfinder", "Navigator", "Master Guide", "Fair Winner", "Grand Fair Winner", "Royal Fair Winner", "Crown Fair Winner");

        return $packages[$this->package_id] . (($this->package_id > 0) ? ' - ' : '') . $ranks[$this->rank];
    }

    public function totalGemPurchases() {
        return $this->gemPurchases
            ->whereNotNull('date_time_approved')
            ->sum('amount');
    }

    public function totalAmountOfOrders() {
        return $this->orders
            ->sum('price');
    }

    public function totalAmountOfOrdersByATerminal() {
        return $this->orders
            ->where('stockist', 0)
            ->where('terminal_user_id', '>', 0)
            ->sum('price');
    }

    public function totalAmountOfOrdersPaid() {
        return $this->totalAmountOfOrders() - $this->totalAmountOfOrdersByATerminal();
    }

    public function totalAmountOfOrdersAsATerminal() {
        return $this->ordersAsATerminal
            ->where('stockist', 1)
            ->sum('price');
    }

    public function totalRankPoints() {
        return $this->rankPoints
            ->sum('points_value');
    }
}
