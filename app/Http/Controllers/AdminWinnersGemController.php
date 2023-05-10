<?php

namespace App\Http\Controllers;

use App\Models\GemPurchase;
use App\Models\WinnersGemValue;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminWinnersGemController extends Controller
{
    public function index() {
        $gemPurchases = $this->getGemPurchases();

        return view('admin.winnersGem.index', compact('gemPurchases'));
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

    public function approvePurchase(Request $request) {
        $request->validate([
            'id' => 'required|integer'
        ]);

        GemPurchase::where('id', $request->id)
            ->update([
                'date_time_approved' => Carbon::now()
            ]);

        $gemPurchases = $this->getGemPurchases();

        return response()->json([
            'content' => (string)view('admin.winnersGem.includes.winnersGemTable', compact('gemPurchases'))
        ]);
    }

    public function removePurchase(Request $request) {
        $request->validate([
            'id' => 'required|integer'
        ]);

        GemPurchase::where('id', $request->id)
            ->delete();

        $gemPurchases = $this->getGemPurchases();

        return response()->json([
            'content' => (string)view('admin.winnersGem.includes.winnersGemTable', compact('gemPurchases'))
        ]);
    }

    public function getGemPurchases() {
        return GemPurchase::select('gem_purchases.*', 'users.firstname', 'users.lastname')
            ->leftJoin('users', 'user_id', 'users.id')
            ->orderBy('gem_purchases.id', 'desc')
            ->get();
    }
}
