<?php

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
