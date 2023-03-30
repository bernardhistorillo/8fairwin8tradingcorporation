<?php

namespace App\Http\Controllers;

use App\Models\Transfer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConversionController extends Controller
{
    public function index($type = null) {
        $conversions['type'] = ($type) ?? 'gem-to-peso';

        if($conversions['type'] == 'gem-to-peso') {
            $conversions['gemToPeso'] = Auth::user()->conversionsGemToPeso();
        } else if($conversions['type'] == 'peso-to-gem') {
            $conversions['pesoToGem'] = Auth::user()->conversionsPesoToGem();;
        }

        return view('conversions.index', compact('conversions'));
    }

    public function submitTransfer(Request $request) {
        $request->validate([
            'username' => 'required|string',
            'amount' => 'required|integer',
            'pin_code' => 'required|numeric',
        ]);

        $income = Auth::user()->income();

        abort_if($request->amount < 1, 422, 'The minimum amount that can be transferred is 1.00.');
        abort_if($income["gemBalance"] < $request->amount, 422, 'Insufficient Winners Gem Balance');
        abort_if(Auth::user()->pin_code != $request->pin_code, 422, 'Invalid Pin Code');

        $receiver = User::where('username', $request->username)
            ->where('id', '!=', Auth::user()->id)
            ->first();

        abort_if(!$receiver, 422, 'Username didn\'t match any account.');

        $transfer = new Transfer();
        $transfer->sender = Auth::user()->id;
        $transfer->receiver = $receiver['id'];
        $transfer->amount = $request->amount;
        $transfer->save();

        return response()->json([
            'gemsSent' => $income["totalGemsSent"] + $request->amount,
            'gemBalance' => $income["gemBalance"] - $request->amount,
        ]);
    }
}
