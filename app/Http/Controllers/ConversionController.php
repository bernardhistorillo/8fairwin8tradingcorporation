<?php

namespace App\Http\Controllers;

use App\Models\Conversion;
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

    public function submitConversion(Request $request) {
        $request->validate([
            'type' => 'required|string',
            'amount' => 'required|integer',
            'winners_gem_value' => 'required|numeric',
        ]);

        abort_if(Auth::user()->package_id == 4, 422, 'Conversion is restricted for accounts with Dream Maker Package.');

        if(winnersGemValue() != $request->winners_gem_value) {
            return response()->json([
                'error' => "Winners Gem value has just changed. Winners Gem to be purchased was updated.",
                'type' =>"winners-gem-update",
                'winners_gem_value' => winnersGemValue(),
            ]);
        }

        $income = Auth::user()->income();
        $gemBalance = 0;
        $pesoBalance = 0;

        if($request->type == "gem-to-peso") {
            abort_if($request->amount < 100, 422, 'Minimum amount that can be converted is 500 Winners Gems.');

            $feePercentage = 0.02;

            abort_if($income["gemBalance"] < $request->amount * ($feePercentage + 1), 422, 'Insufficient Winners Gem Balance');

            $feeInGems = $request->amount * $feePercentage;
            $fee_in_pesos = $feeInGems * winnersGemValue();
            $pesos = $request->amount * winnersGemValue();

            $conversion = new Conversion();
            $conversion->user_id = Auth::user()->id;
            $conversion->type = 1;
            $conversion->gem = $request->amount;
            $conversion->peso = $pesos;
            $conversion->fee_in_gems = $feeInGems;
            $conversion->fee_in_pesos = $fee_in_pesos;
            $conversion->save();

            $gemBalance = $income["gemBalance"] - ($request->amount + $feeInGems);
            $pesoBalance = $income["pesoBalance"] + $pesos;
        } else if($request->type == "peso-to-gem") {
            abort_if($request->amount < 1, 422, 'Minimum amount that can be converted is &#x20B1;&nbsp;1.00.');
            abort_if($income["pesoBalance"] < $request->amount, 422, 'Insufficient Peso Balance');

            $gems = $request->amount / winnersGemValue();

            $conversion = new Conversion();
            $conversion->user_id = Auth::user()->id;
            $conversion->type = 2;
            $conversion->gem = $gems;
            $conversion->peso = $request->amount;
            $conversion->fee_in_gems = 0;
            $conversion->fee_in_pesos = 0;
            $conversion->save();

            $pesoBalance = $income["pesoBalance"] - $request->amount;
            $gemBalance = $income["gemBalance"] + $gems;
        } else {
            abort(422, 'Invalid Conversion Data');
        }

        return response()->json([
            'gemBalance' => $gemBalance,
            'pesoBalance' => $pesoBalance,
        ]);
    }
}
