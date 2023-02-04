<?php

namespace App\Http\Controllers;

use App\Models\GemPurchase;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
            'price' => 'required|numeric',
            'winners_gem_value' => 'required|numeric',
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
            $proofOfPaymentsLocations = [];
            foreach(json_decode($request->proof_of_payments, true) as $proofOfPayment) {
                $file = file_get_contents($proofOfPayment['image']);
                $name = Str::random(40) . '.' . $proofOfPayment['extension'];

                $path = config('filesystems.disks.do.folder') . '/gem_purchases/' . Auth::user()->id . '/';
                Storage::disk('do')->put($path . $name, $file);

                $proofOfPaymentsLocations[] = config('filesystems.disks.do.cdn_endpoint') . $path . $name;
            }

            $gemPurchase = new GemPurchase();
            $gemPurchase->user_id = Auth::user()->id;
            $gemPurchase->amount = $request->price / $currentWinnersGemValue;
            $gemPurchase->price = $request->price;
            $gemPurchase->proof_of_payment = json_encode($proofOfPaymentsLocations);
            $gemPurchase->save();
        } else {
            abort(422, "Enter Winners Gem amount");
        }

        return response()->json([]);
    }

    public function placeOrder(Request $request) {

    }

    public function automaticFdpUpgrade($userId, $rank, $packageId) {
        global $date_time;
        global $mass_place_order;

        if($rank == 1 && $packageId == 2 && $package_id == 4) {
            $earnings = earnings($account_id);

            if($earnings["peso_balance"] >= 4980) {
                $sql = $db->prepare("INSERT INTO `fw_conversions`(`account_id`, `type`, `amount`, `fee`, `date_time`) VALUES (?, ?, ?, ?, ?)");
                if (!$sql->execute(array($account_id, 2, 4980, 0, $date_time))) { error(""); }

                $sql = $db->prepare("SELECT `full_name`, `contact_number`, `barangay`, `city`, `province`, `zip_code` FROM `fw_orders` WHERE `account_id` = ? AND `type` = 1 LIMIT 1");
                if (!$sql->execute(array($account_id))) { error(""); }
                $previous_order_details = $sql->fetch(PDO::FETCH_ASSOC);

                if(!$mass_place_order) {
                    place_order($account_id, array((object) ["id" => 1, "quantity" => 1]), 0, $previous_order_details["full_name"], $previous_order_details["contact_number"], $previous_order_details["barangay"], $previous_order_details["city"], $previous_order_details["province"], $previous_order_details["zip_code"], false);
                }
            }
        }
    }
}
