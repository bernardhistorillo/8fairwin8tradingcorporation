<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\PoolShareContribution;
use App\Models\PoolShareIncome;
use App\Models\StairstepIncome;
use App\Models\UnilevelIncome;
use Illuminate\Http\Request;

class HelperController extends Controller
{
    public static function totalPoolShares() {
        $latestPoolShareIncome = PoolShareIncome::query()
            ->latest()
            ->first();

        $totalPoolShares = Order::where('date_time_placed', '>', $latestPoolShareIncome['date_time'])
            ->sum('pool_share');

        $totalPoolShares += PoolShareContribution::where('created_at', '>', $latestPoolShareIncome['date_time'])
            ->sum('amount');

        $totalPoolShares += UnilevelIncome::where('created_at', '>', $latestPoolShareIncome['date_time'])
            ->where('received', 0)
            ->sum('amount');

        $totalPoolShares += StairstepIncome::where('created_at', '>', $latestPoolShareIncome['date_time'])
            ->where('received', 0)
            ->sum('amount');

        return $totalPoolShares;
    }
}
