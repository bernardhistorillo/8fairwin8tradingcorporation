<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function items() {
        return Item::select('items.*', 'ordered_items.price', 'ordered_items.quantity')
            ->join('ordered_items', 'items.id', 'ordered_items.item_id')
            ->join('orders', 'ordered_items.order_id', 'orders.id')
            ->where('orders.id', $this->id)
            ->get();
    }

    public function referralIncomes() {
        return $this->hasMany(ReferralIncome::class);
    }

    public function infinityPlusIncomes() {
        return $this->hasMany(InfinityPlusIncome::class);
    }

    public function unilevelIncomes() {
        return $this->hasMany(UnilevelIncome::class);
    }

    public function stairstepIncomes() {
        return $this->hasMany(StairstepIncome::class);
    }

    public function personalRebateIncome() {
        return $this->hasMany(PersonalRebateIncome::class);
    }
}
