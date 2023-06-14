<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class IncomeController extends Controller
{
    public function index($type = null) {
        $income['type'] = ($type) ?? 'referral';

        if($income['type'] == 'referral') {
            $income['referral'] = Auth::user()->referralIncomes()
                ->select('referral_incomes.*', 'users.firstname', 'users.lastname')
                ->where('amount', '>', 0)
                ->leftJoin('users', 'downline', 'users.id')
                ->latest()
                ->get();
        } else if($income['type'] == 'unilevel') {
            $income['unilevel'] = Auth::user()->unilevelIncomes()
                ->select('unilevel_incomes.*', 'users.firstname', 'users.lastname')
                ->where('amount', '>', 0)
                ->where('received', 1)
                ->leftJoin('users', 'downline', 'users.id')
                ->latest()
                ->get();
        } else if($income['type'] == 'stairstep') {
            $income['stairstep'] = Auth::user()->stairstepIncomes()
                ->select('stairstep_incomes.*', 'users.firstname', 'users.lastname')
                ->where('amount', '>', 0)
                ->where('received', 1)
                ->leftJoin('orders', 'order_id', 'orders.id')
                ->leftJoin('users', 'orders.user_id', 'users.id')
                ->latest()
                ->get();
        } else if($income['type'] == 'personalrebate') {
            $income['personalRebate'] = Auth::user()->personalRebateIncomes()
                ->select('personal_rebate_incomes.*', 'reference')
                ->where('amount', '>', 0)
                ->leftJoin('orders', 'order_id', 'orders.id')
                ->latest()
                ->get();
        } else if($income['type'] == 'infinityplusbonus') {
            $income['infinityPlusBonus'] = Auth::user()->infinityPlusIncomes()
                ->select('infinity_plus_incomes.*', 'users.firstname', 'users.lastname')
                ->where('amount', '>', 0)
                ->leftJoin('users', 'downline', 'users.id')
                ->latest()
                ->get();
        } else if($income['type'] == 'rankincentive') {
            $income['rankIncentive'] = Auth::user()->rankIncentiveIncomes()
                ->where('amount', '>', 0)
                ->latest()
                ->get();
        } else if($income['type'] == 'royaltybonus') {
            $income['royaltyBonus'] = Auth::user()->royaltyBonusIncomes()
                ->select('royalty_bonus_incomes.*', 'users.firstname', 'users.lastname')
                ->where('amount', '>', 0)
                ->leftJoin('users', 'downline', 'users.id')
                ->latest()
                ->get();
        } else if($income['type'] == 'poolsharebonus') {
            $income['poolShare'] = Auth::user()->poolShareIncomes()
                ->where('amount', '>', 0)
                ->latest()
                ->get();
        }

        return view('income.index', compact('income'));
    }
}
