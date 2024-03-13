<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
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

    // Start: Relationships
    public function conversions() {
        return $this->hasMany(Conversion::class);
    }

    public function downlines() {
        return $this->hasMany(Downline::class, 'upline');
    }

    public function gemPurchases() {
        return $this->hasMany(GemPurchase::class);
    }

    public function gemsReceived() {
        return $this->hasMany(Transfer::class, 'receiver');
    }

    public function gemsSent() {
        return $this->hasMany(Transfer::class, 'sender');
    }

    public function infinityPlusIncomes() {
        return $this->hasMany(InfinityPlusIncome::class, 'upline');
    }

    public function orders() {
        return $this->hasMany(Order::class);
    }

    public function ordersAsATerminal() {
        return $this->hasMany(Order::class, 'terminal_user_id');
    }

    public function payoutInformation() {
        $payoutInformation = $this->hasOne(PayoutInformation::class)
            ->first();

        if(!$payoutInformation) {
            $payoutInformation["method"] = "";
            $payoutInformation["account_number"] = "";
            $payoutInformation["account_name"] = "";
            $payoutInformation["name"] = "";
            $payoutInformation["mobile_number"] = "";
            $payoutInformation["wallet_address"] = "";

            $validPayoutInformation = false;
        } else {
            if($payoutInformation["method"] == "BDO" && $payoutInformation["account_number"] != "" && $payoutInformation["account_name"] != "") {
                $validPayoutInformation = true;
            } else if($payoutInformation["method"] == "Palawan Express" && $payoutInformation["name"] != "" && $payoutInformation["mobile_number"] != "") {
                $validPayoutInformation = true;
            } else if($payoutInformation["method"] == "GCash" && $payoutInformation["mobile_number"] != "") {
                $validPayoutInformation = true;
            } else if($payoutInformation["method"] == "Coins.ph" && $payoutInformation["mobile_number"] != "") {
                $validPayoutInformation = true;
            } else {
                $validPayoutInformation = false;
            }
        }

        return [
            'payoutInformation' => $payoutInformation,
            'validPayoutInformation' => $validPayoutInformation,
        ];
    }

    public function personalRebateIncomes() {
        return $this->hasMany(PersonalRebateIncome::class);
    }

    public function poolShareContributions() {
        return $this->hasMany(PoolShareContribution::class);
    }

    public function poolShareIncomes() {
        return $this->hasMany(PoolShareIncome::class);
    }

    public function rankIncentiveIncomes() {
        return $this->hasMany(RankIncentiveIncome::class);
    }

    public function rankPoints() {
        return $this->hasMany(RankPoint::class);
    }

    public function referralIncomes() {
        return $this->hasMany(ReferralIncome::class, 'upline');
    }

    public function royaltyBonusIncomes() {
        return $this->hasMany(RoyaltyBonusIncome::class);
    }

    public function stairstepIncomes() {
        return $this->hasMany(StairstepIncome::class, 'upline');
    }

    public function stockistAssignment() {
        return $this->hasOne(StockistAssignment::class, 'assigned');
    }

    public function unilevelIncomes() {
        return $this->hasMany(UnilevelIncome::class, 'upline');
    }

    public function withdrawals() {
        return $this->hasMany(Withdrawal::class);
    }
    // End: Relationships

    public function conversionsGemToPeso() {
        return $this->conversions()
            ->where('type', 1)
            ->orderBy('id', 'desc')
            ->get();
    }

    public function conversionsPesoToGem() {
        return $this->conversions()
            ->where('type', 2)
            ->orderBy('id', 'desc')
            ->get();
    }

    public function directCount() {
        return $this->downlines()
            ->where('level', 1)
            ->count('id');
    }

    public function downlineCount() {
        return $this->downlines
            ->count('id');
    }

    public function fullName() {
        return $this->firstname . ' ' . $this->lastname;
    }

    public function income() {
        $data['totalReferralIncome'] = $this->totalReferralIncome();
        $data['totalUnilevelIncome'] = $this->totalUnilevelIncome();
        $data['totalStairstepIncome'] = $this->totalStairstepIncome();
        $data['totalPersonalRebateIncome'] = $this->totalPersonalRebateIncome();
        $data['totalInfinityPlusIncome'] = $this->totalInfinityPlusIncome();
        $data['totalRankIncentiveIncome'] = $this->totalRankIncentiveIncome();
        $data['totalRoyaltyBonusIncome'] = $this->totalRoyaltyBonusIncome();
        $data['totalPoolShareIncome'] = $this->totalPoolShareIncome();

        $data['totalGemPurchases'] = $this->totalGemPurchases();
        $data['totalGemsReceived'] = $this->totalGemsReceived();
        $data['totalGemConvertedFromPeso'] = $this->totalGemConvertedFromPeso();
        $data['totalAmountOfSoldOrdersAsACenterStockist'] = $this->totalAmountOfSoldOrdersAsACenterStockist();
        $data['totalAmountOfOrdersPaid'] = $this->totalAmountOfOrdersPaid();
        $data['totalGemsSent'] = $this->totalGemsSent();
        $data['totalGemConvertedToPeso'] = $this->totalGemConvertedToPeso();
        $data['totalGemFeeForConversion'] = $this->totalGemFeeForConversion();

        $data['gemBalance'] = (
            $data['totalGemPurchases'] +
            $data['totalGemsReceived'] +
            $data['totalGemConvertedFromPeso'] +
            $data['totalAmountOfSoldOrdersAsACenterStockist']
        ) - (
            $data['totalAmountOfOrdersPaid'] +
            $data['totalGemsSent'] +
            $data['totalGemConvertedToPeso'] +
            $data['totalGemFeeForConversion']
        );

        $data['totalIncome'] = (
            $data['totalReferralIncome'] +
            $data['totalUnilevelIncome'] +
            $data['totalStairstepIncome'] +
            $data['totalPersonalRebateIncome'] +
            $data['totalInfinityPlusIncome'] +
            $data['totalRankIncentiveIncome'] +
            $data['totalRoyaltyBonusIncome'] +
            $data['totalPoolShareIncome']
        );

        $data['totalPesoConvertedFromGem'] = $this->totalPesoConvertedFromGem();
        $data['totalPesoConvertedToGem'] = $this->totalPesoConvertedToGem();
        $data['totalWithdrawn'] = $this->totalWithdrawn();
        $data['totalWithdrawalFee'] = $this->totalWithdrawalFee();
        $data['totalPoolShareContribution'] = $this->totalPoolShareContribution();

        $data['pesoBalance'] = (
            $data['totalIncome'] +
            $data['totalPesoConvertedFromGem']
        ) - (
            $data['totalPesoConvertedToGem'] +
            $data['totalWithdrawn'] +
            $data['totalWithdrawalFee'] +
            $data['totalPoolShareContribution']
        );

        return $data;
    }

    public function hasNoPurchaseFor180days() {
        $order = $this->orders()
            ->where('type', 2)
            ->where('stockist', 0)
            ->latest()
            ->first();

        $hasNoPurchaseFor180days = true;

        if($order) {
            $createdDate = Carbon::parse($order['created_at']);
            $now = Carbon::now();

            $diffInDays = $now->diffInDays($createdDate);

            $hasNoPurchaseFor180days = $diffInDays > 180;
        }

        return $hasNoPurchaseFor180days;
    }

    public function latestShippingInformation() {
        return $this->orders()
            ->whereNotNull('full_name')
            ->whereNotNull('contact_number')
            ->whereNotNull('barangay')
            ->whereNotNull('city')
            ->whereNotNull('province')
            ->whereNotNull('zip_code')
            ->latest()
            ->first();
    }

    public function maintainedMonthsOverSixMonths() {
        $maintainedMonthsCount = 0;

        for($i = 0; $i < 6; $i++) {
            $startDate = Carbon::now()->startOfMonth()->subMonths($i)->toDateTimeString();

            if($this->monthlyPVMaintenance($startDate) >= 100) {
                $maintainedMonthsCount++;

                if($maintainedMonthsCount >= 3) {
                    break;
                }
            }
        }

        return $maintainedMonthsCount;
    }

    public function monthlyPVMaintenance($startDate) {
        return $this->orders
            ->where('type', 2)
            ->where('stockist', 0)
            ->where('created_at', '>=', $startDate)
            ->where('created_at', '<=', Carbon::parse($startDate)->endOfMonth()->toDateTimeString())
            ->sum('points_value');
    }

    public function rankLegCount($rank) {
        return $this->downlines()
            ->join('users', function($join) use ($rank) {
                $join->on('downline', 'users.id');
                $join->where('rank', $rank);
            })
            ->distinct('leg')
            ->count('leg');
    }

    public function requiredPVMaintenance() {
        $requiredPVMaintenance = 100;

        if($this->rank >= 2 && $this->rank <= 5) {
            $requiredPVMaintenance = 200;
        } else if($this->rank == 6) {
            $requiredPVMaintenance = 300;
        } else if($this->rank >= 7 && $this->rank <= 9) {
            $requiredPVMaintenance = 500;
        }

        return $requiredPVMaintenance;
    }

    public function packageAndRank() {
        $packages = ["", "DBP", "DSP", "FDP", "DMP", "FSP", "FPP"];

        return $packages[$this->package_id] . (($this->package_id > 0) ? ' - ' : '') . ranks()[$this->rank];
    }

    public function photo() {
        return ($this->photo) ? asset($this->photo) : 'https://api.dicebear.com/7.x/avataaars/svg?seed=' . $this->id . '&mouth=smile&eyebrows=default&backgroundColor=b6e3f4,c0aede,d1d4f9';
    }

    public function terminalWinnersGem() {
        $stockedItems = $this->orders()
            ->select('ordered_items.*')
            ->join('ordered_items', 'orders.id', 'ordered_items.order_id')
            ->where('stockist', $this->stockist)
            ->whereNotNull('date_time_completed')
            ->get();

        $terminalWinnersGem["stockedPoints"] = 0;
        foreach($stockedItems as $stockedItem) {
            $terminalWinnersGem["stockedPoints"] += $stockedItem["quantity"] * $stockedItem["points_value"];
        }

        $orderedItems = $this->ordersAsATerminal()
            ->select('ordered_items.*')
            ->join('ordered_items', 'orders.id', 'ordered_items.order_id')
            ->whereNotNull('date_time_completed')
            ->get();

        $terminalWinnersGem["orderedPoints"] = 0;
        foreach($orderedItems as $orderedItem) {
            $terminalWinnersGem["orderedPoints"] += $orderedItem["quantity"] * $orderedItem["points_value"];
        }

        $terminalWinnersGem["balance"] = $terminalWinnersGem["stockedPoints"] - $terminalWinnersGem["orderedPoints"];

        return $terminalWinnersGem;
    }

    public function totalPesoConvertedToGem() {
        // peso to gem
        return $this->conversions
            ->where('type', 2)
            ->sum('peso');
    }

    public function totalGemConvertedFromPeso() {
        // peso to gem
        return $this->conversions
            ->where('type', 2)
            ->sum('gem');
    }

    public function totalGemConvertedToPeso() {
        // gem to peso
        return $this->conversions
            ->where('type', 1)
            ->sum('gem');
    }

    public function totalPesoConvertedFromGem() {
        // gem to peso
        return $this->conversions
            ->where('type', 1)
            ->sum('peso');
    }

    public function totalGemFeeForConversion() {
        return $this->conversions
            ->where('type', 1)
            ->sum('fee_in_gems');
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

    public function totalAmountOfSoldOrdersAsACenterStockist() {
        return $this->ordersAsATerminal
            ->where('stockist', 1)
            ->sum('price');
    }

    public function totalGemsReceived() {
        return $this->gemsReceived
            ->sum('amount');
    }

    public function totalGemsSent() {
        return $this->gemsSent
            ->sum('amount');
    }

    public function totalInfinityPlusIncome() {
        return $this->infinityPlusIncomes
            ->sum('amount');
    }

    public function totalPoolShareContribution() {
        return $this->poolShareContributions
            ->sum('amount');
    }

    public function totalRankIncentiveIncome() {
        return $this->rankIncentiveIncomes
            ->sum('amount');
    }

    public function totalRankPoints() {
        return $this->rankPoints
            ->sum('points_value');
    }

    public function totalRoyaltyBonusIncome() {
        return $this->royaltyBonusIncomes
            ->sum('amount');
    }

    public function totalPersonalRebateIncome() {
        return $this->personalRebateIncomes
            ->sum('amount');
    }

    public function totalPoolShareIncome() {
        return $this->poolShareIncomes
            ->sum('amount');
    }

    public function totalReferralIncome() {
        return $this->referralIncomes
            ->sum('amount');
    }

    public function totalStairstepIncome() {
        return $this->stairstepIncomes
            ->where('received', 1)
            ->sum('amount');
    }

    public function totalUnilevelIncome() {
        return $this->unilevelIncomes
            ->where('received', 1)
            ->sum('amount');
    }

    public function totalWithdrawn() {
        return $this->withdrawals
            ->sum('amount');
    }

    public function totalWithdrawalFee() {
        return $this->withdrawals
            ->sum('fee');
    }

    public function transfersReceived() {
        return Transfer::select('transfers.*', 'firstname', 'lastname')
            ->join('users', 'sender', 'users.id')
            ->where('receiver', $this->id)
            ->orderBy('transfers.id', 'desc')
            ->get();
    }

    public function transfersSent() {
        return Transfer::select('transfers.*', 'firstname', 'lastname')
            ->join('users', 'receiver', 'users.id')
            ->where('sender', $this->id)
            ->orderBy('transfers.id', 'desc')
            ->get();
    }

}
