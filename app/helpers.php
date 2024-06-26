<?php

use App\Models\Item;
use App\Models\Order;
use App\Models\PoolShareContribution;
use App\Models\PoolShareIncome;
use App\Models\StairstepIncome;
use App\Models\UnilevelIncome;
use Carbon\Carbon;

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
        return session('winnersGemValue');
    }
}

if(!function_exists('fullName')) {
    function fullName($data) {
        return $data['firstname'] . ' ' . $data['lastname'];
    }
}

if(!function_exists('ranks')) {
    function ranks() {
        return array("Free Account", "Dealer", "Explorer", "Pathfinder", "Navigator", "Master Guide", "Fair Winner", "Grand Fair Winner", "Royal Fair Winner", "Crown Fair Winner");
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

if(!function_exists('fairwinBuilderPackagePrice')) {
    function fairwinBuilderPackagePrice() {
        $item = Item::where('package_id', 7)
            ->first();

        return $item['suggested_retail_price'];
    }
}

if(!function_exists('generateCode')) {
    function generateCode($length) {
        $characters = "ABCDEFGHJKLMNPQRSTUVWXYZ23456789";
        $charactersLength = strlen($characters);
        $generatedCode = "";
        for ($j = 0; $j < $length; $j++) {
            $generatedCode = $generatedCode . $characters[rand(0, $charactersLength - 1)];
        }

        return $generatedCode;
    }
}

if(!function_exists('generateOTP')) {
    function generateOTP($length) {
        $characters = "0123456789";
        $charactersLength = strlen($characters);
        $generatedCode = "";
        for ($j = 0; $j < $length; $j++) {
            $generatedCode = $generatedCode . $characters[rand(0, $charactersLength - 1)];
        }

        return $generatedCode;
    }
}

if(!function_exists('formatDate')) {
    function formatDate($date) {
        return Carbon::parse($date)->isoFormat('llll');
    }
}

if(!function_exists('numberToWords')) {
    function numberToWords($number) {
        $formatter = new NumberFormatter('en', NumberFormatter::SPELLOUT);
        return $formatter->format($number);
    }
}

if(!function_exists('packages')) {
    function packages() {
        // Package Levels: 0 -> (4 / 5) -> (2 / 6) -> (1 / 3 / 7)

        return [
            [
                'package_id' => 4,
                'availed' => false,
                'level' => 1
            ], [
                'package_id' => 5,
                'availed' => false,
                'level' => 1
            ], [
                'package_id' => 2,
                'availed' => false,
                'level' => 2
            ], [
                'package_id' => 6,
                'availed' => false,
                'level' => 2
            ], [
                'package_id' => 1,
                'availed' => false,
                'level' => 3
            ], [
                'package_id' => 3,
                'availed' => false,
                'level' => 3
            ], [
                'package_id' => 7,
                'availed' => false,
                'level' => 3
            ]
        ];
    }
}

if(!function_exists('levelPackages')) {
    function levelPackages($level) {
        $levelPackages = [];

        foreach(packages() as $package) {
            if($package['level'] == $level) {
                $levelPackages[] = $package['package_id'];
            }
        }

        return $levelPackages;
    }
}
