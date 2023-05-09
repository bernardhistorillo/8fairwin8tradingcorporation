<?php

namespace App\Http\Controllers;

use App\Models\WinnersGemValue;
use Illuminate\Http\Request;

class AdminWinnersGemController extends Controller
{
    public function index() {
        return view('admin.dashboard.index');
    }

    public function updateValue(Request $request) {
        $request->validate([
            'winners_gem_value' => 'required'
        ]);

        $winnersGemValue = new WinnersGemValue();
        $winnersGemValue->percentage = $request->winners_gem_value;
        $winnersGemValue->save();

        return response()->json([
            'winnersGemValue' => number_format($winnersGemValue['percentage'],2)
        ]);
    }
}
