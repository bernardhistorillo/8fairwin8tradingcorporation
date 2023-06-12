<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\ReferralIncome;
use Illuminate\Http\Request;

class AdminIncomeDistributionController extends Controller
{
    public function index(Request $request) {
        $orders = Order::select('orders.*', 'users.firstname', 'users.lastname')
            ->leftJoin('users', 'user_id', 'users.id')
            ->latest()
            ->paginate(10);

        foreach($orders as $order) {
            if($order['type'] == 1) {
                $order['referralIncomes'] = $order->referralIncomes()
                    ->select('referral_incomes.*', 'users.firstname', 'users.lastname')
                    ->leftJoin('users', 'upline', 'users.id')
                    ->paginate(10);
            }
        }

        return view('admin.incomeDistribution.index', compact('orders'));
    }
}
