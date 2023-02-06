<?php

use App\Models\Item;
use App\Models\Order;
use App\Models\PoolShareContribution;
use App\Models\PoolShareIncome;
use App\Models\StairstepIncome;
use App\Models\UnilevelIncome;
use App\Models\WinnersGemValue;

if(!function_exists('totalPoolShares')) {
    function totalPoolShares() {
        $latestPoolShareIncome = PoolShareIncome::query()
            ->latest()
            ->first();

        $totalPoolShares = Order::where('created_at', '>', $latestPoolShareIncome['created_at'])
            ->sum('pool_share');

        $totalPoolShares += PoolShareContribution::where('created_at', '>', $latestPoolShareIncome['created_at'])
            ->sum('amount');

        $totalPoolShares += UnilevelIncome::where('created_at', '>', $latestPoolShareIncome['created_at'])
            ->where('received', 0)
            ->sum('amount');

        $totalPoolShares += StairstepIncome::where('created_at', '>', $latestPoolShareIncome['created_at'])
            ->where('received', 0)
            ->sum('amount');

        return $totalPoolShares;
    }
}

if(!function_exists('winnersGemValue')) {
    function winnersGemValue() {
        $winnersGemValue = WinnersGemValue::latest()
            ->first();

        return $winnersGemValue['percentage'];
    }
}

if(!function_exists('fullName')) {
    function fullName($data) {
        return $data['firstname'] . ' ' . $data['lastname'];
    }
}

if(!function_exists('ranks')) {
    function ranks() {
        return $ranks = array("Free Account", "Dealer", "Explorer", "Pathfinder", "Navigator", "Master Guide", "Fair Winner", "Grand Fair Winner", "Royal Fair Winner", "Crown Fair Winner");
    }
}

if(!function_exists('totalPoolShares')) {
    function totalPoolShares() {
        $latestPoolShareIncome = PoolShareIncome::query()
            ->latest()
            ->first();

        $totalPoolShares = Order::where('created_at', '>', $latestPoolShareIncome['created_at'])
            ->sum('pool_share');

        $totalPoolShares += PoolShareContribution::where('created_at', '>', $latestPoolShareIncome['created_at'])
            ->sum('amount');

        $totalPoolShares += UnilevelIncome::where('created_at', '>', $latestPoolShareIncome['created_at'])
            ->where('received', 0)
            ->sum('amount');

        $totalPoolShares += StairstepIncome::where('created_at', '>', $latestPoolShareIncome['created_at'])
            ->where('received', 0)
            ->sum('amount');

        return $totalPoolShares;
    }
}

if(!function_exists('fairwinDreamPackagePrice')) {
    function fairwinDreamPackagePrice() {
        $item = Item::where('package_id', 3)
            ->first();

        return $item['suggested_retail_price'];
    }
}
