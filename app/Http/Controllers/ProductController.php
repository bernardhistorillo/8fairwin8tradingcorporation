<?php

namespace App\Http\Controllers;

use App\Models\GemPurchase;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index() {
        $winnersGemValue = winnersGemValue();

        $items = Item::where('status', 1)
            ->orderBy('name')
            ->get();

        $terminalAccount = false;
        $terminalAccountDetails = false;

        $showProductsTab = (!$terminalAccount && Auth::user()->package_id != 3) || ($terminalAccount && $terminalAccountDetails["package_id"] != 3);
        $income = Auth::user()->income();

        return view('products.index', compact('winnersGemValue', 'items', 'showProductsTab', 'terminalAccount', 'terminalAccountDetails', 'income'));
    }

    public function purchaseWinnersGem(Request $request) {
        $request->validate([
            'price' => 'required}numeric',
            'winners_gem_value' => 'required}numeric',
            'proof_of_payments.*' => 'required|mimes:jpg,jpeg,png,bmp,tiff|max:10240',
        ]);

        $currentWinnersGemValue = winnersGemValue();

        if($request->winners_gem_value != $currentWinnersGemValue) {
            return response()->json([
                "type" => "winners-gem-update",
                "winners_gem_value" => $currentWinnersGemValue
            ]);
        }

        if($request->price > 0) {
            $proof_of_payments_locations = [];
            foreach($request->file('proof_of_payments') as $proof_of_payment) {
                $file = $proof_of_payment;
                $name = $this->hashName();
                $path = config('filesystems.disks.do.folder') . '/gem_purchases/' . Auth::user()->id . '/';
                Storage::put('public/' . $path, $file);

                $proof_of_payments_locations[] = config('filesystems.disks.do.cdn_endpoint') . $path . $name;
            }

            $gemPurchase = new GemPurchase();
            $gemPurchase->user_id = Auth::user()->id;
            $gemPurchase->amount = $request->price / $currentWinnersGemValue;
            $gemPurchase->price = $request->price;
            $gemPurchase->proof_of_payment = json_encode($proof_of_payments_locations);
            $gemPurchase->save();
        } else {
            abort(422, "Enter Winners Gem amount");
        }

        return response()->json([]);
    }
}
