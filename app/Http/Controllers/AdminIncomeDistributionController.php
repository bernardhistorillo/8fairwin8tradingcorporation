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

        $order['distributed'] = 0;

        foreach($orders as $order) {
            if($order['type'] == 1) {
                $order['referralIncomes'] = $order->referralIncomes()
                    ->select('referral_incomes.*', 'users.firstname', 'users.lastname')
                    ->leftJoin('users', 'upline', 'users.id')
                    ->get();

                $order['referralIncomesTotal'] = 0;
                foreach($order['referralIncomes'] as $referralIncome) {
                    $order['referralIncomesTotal'] += $referralIncome['amount'];
                    $order['distributed'] += $referralIncome['amount'];
                }

                $order['infinityPlusIncomes'] = $order->infinityPlusIncomes()
                    ->select('infinity_plus_incomes.*', 'users.firstname', 'users.lastname')
                    ->leftJoin('users', 'upline', 'users.id')
                    ->get();

                $order['infinityPlusIncomesTotal'] = 0;
                foreach($order['infinityPlusIncomes'] as $infinityPlusIncome) {
                    $order['infinityPlusIncomesTotal'] += $infinityPlusIncome['amount'];
                    $order['distributed'] += $infinityPlusIncome['amount'];
                }
            } else {
                $order['unilevelIncomes'] = $order->unilevelIncomes()
                    ->select('unilevel_incomes.*', 'users.firstname', 'users.lastname', 'received')
                    ->leftJoin('users', 'upline', 'users.id')
                    ->get();

                $order['unilevelIncomesTotal'] = 0;
                foreach($order['unilevelIncomes'] as $unilevelIncome) {
                    if($unilevelIncome['received'] == 1) {
                        $order['unilevelIncomesTotal'] += $unilevelIncome['amount'];
                        $order['distributed'] += $unilevelIncome['amount'];
                    }
                }

                $order['stairstepIncomes'] = $order->stairstepIncomes()
                    ->select('stairstep_incomes.*', 'users.firstname', 'users.lastname', 'received')
                    ->leftJoin('users', 'upline', 'users.id')
                    ->get();

                $order['stairstepIncomesTotal'] = 0;
                foreach($order['stairstepIncomes'] as $stairstepIncome) {
                    if($stairstepIncome['received'] == 1) {
                        $order['stairstepIncomesTotal'] += $stairstepIncome['amount'];
                        $order['distributed'] += $stairstepIncome['amount'];
                    }
                }

                $order['personalRebateIncome'] = $order->personalRebateIncome()
                    ->select('amount')
                    ->first();

                $order['distributed'] += $order['personalRebateIncome']['amount'];
            }

            $order['distributed'] += $order['pool_share'];
        }

        return view('admin.incomeDistribution.index', compact('orders'));
    }
}
