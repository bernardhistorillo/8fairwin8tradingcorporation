<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\ReferralIncome;
use Illuminate\Http\Request;

class AdminIncomeDistributionController extends Controller
{
    public function index(Request $request) {
        $orders = Order::latest()
            ->paginate(10);

        foreach($orders as $order) {
            if($order['type'] == 1) {
                $order['referralIncomes'] = $order->referralIncomes();
            }
        }

        return view('admin.incomeDistribution.index', compact('orders'));
    }
}
