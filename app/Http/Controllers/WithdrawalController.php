<?php

namespace App\Http\Controllers;

use App\Models\Conversion;
use App\Models\Transfer;
use App\Models\User;
use App\Models\Withdrawal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use League\CommonMark\Inline\Element\AbstractInline;

class WithdrawalController extends Controller
{
    public function index() {
        $withdrawals = Auth::user()->withdrawals()
            ->latest()
            ->get();

        $payoutInformation = Auth::user()->payoutInformation();
        $validPayoutInformation = $payoutInformation['validPayoutInformation'];
        $payoutInformation = $payoutInformation['payoutInformation'];

        return view('withdrawals.index', compact('withdrawals', 'validPayoutInformation', 'payoutInformation'));
    }

    public function submitWithdrawal(Request $request) {
        $request->validate([
            'amount' => 'required|integer',
        ]);

        abort_if(Auth::user()->package_id == 4, 422, 'Withdrawal is restricted for accounts with Dream Maker Package.');

        $payoutInformation = Auth::user()->payoutInformation();
        $validPayoutInformation = $payoutInformation['validPayoutInformation'];
        $payoutInformation = $payoutInformation['payoutInformation'];

        abort_if(!$validPayoutInformation, 422, 'Your payout information is not yet finished.');

        $income = Auth::user()->income();

        abort_if($request->amount < 500, 422, 'Minimum withdrawal is <i class="fa-solid fa-peso-sign"></i>&nbsp;500.00.');
        abort_if($income["pesoBalance"] < $request->amount * 1.01, 422, 'Insufficient Balance');

        $fee = $request->amount * 0.01;

        $withdrawal = new Withdrawal();
        $withdrawal->user_id = Auth::user()->id;
        $withdrawal->amount = $request->amount;
        $withdrawal->fee = $fee;
        $withdrawal->payout_information = json_encode($payoutInformation);
        $withdrawal->save();

        return response()->json();
    }
}
