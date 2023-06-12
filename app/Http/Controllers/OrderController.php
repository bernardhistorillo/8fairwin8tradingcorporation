<?php

namespace App\Http\Controllers;

use App\Models\Conversion;
use App\Models\Downline;
use App\Models\GemPurchase;
use App\Models\InfinityPlusIncome;
use App\Models\Item;
use App\Models\Order;
use App\Models\OrderedItem;
use App\Models\PersonalRebateIncome;
use App\Models\RankIncentiveIncome;
use App\Models\RankPoint;
use App\Models\ReferralIncome;
use App\Models\StairstepIncome;
use App\Models\UnilevelIncome;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function index($type = null) {
        $orders['type'] = ($type) ?? 'products';

        if($orders['type'] == 'products') {
            $orders['products'] = Auth::user()->orders()
                ->latest()
                ->get();
        } else if($orders['type'] == 'winnersgem') {
            $orders['winnersGem'] = Auth::user()->gemPurchases()
                ->latest()
                ->get();
        }

        return view('orders.index', compact('orders'));
    }

    public function viewItems(Request $request) {
        $request->validate([
            'order_id' => 'required|numeric',
        ]);

        $order = Order::where('id', $request->order_id)
            ->where(function($query) {
                $query->where('user_id', Auth::user()->id);
                $query->orWhere('terminal_user_id', Auth::user()->id);
            })
            ->first();

        abort_if(!$order, 422, 'Invalid Order');

        $items = $order->items();

        foreach($items as $item) {
            $item['photo'] = $item->photo();
            $item['longestDimension'] = $item->longestDimension();
        }

        return response()->json([
            'items' => $items
        ]);
    }

    public function updateProofOfPayment(Request $request) {
        $request->validate([
            'id' => 'required|numeric',
        ]);

        $gemPurchase = GemPurchase::where('id', $request->id)
            ->where('user_id', Auth::user()->id)
            ->first();

        abort_if(!$gemPurchase, 422, 'Invalid Gem Purchase');

        $proofOfPaymentsLocations = [];
        foreach(json_decode($request->proof_of_payments, true) as $proofOfPayment) {
            $file = file_get_contents($proofOfPayment['image']);
            $name = Str::random(40) . '.' . $proofOfPayment['extension'];

            $path = config('filesystems.disks.do.folder') . '/gem_purchases/' . Auth::user()->id . '/';
            Storage::disk('do')->put($path . $name, $file);

            $proofOfPaymentsLocations[] = config('filesystems.disks.do.cdn_endpoint') . $path . $name;
        }

        $gemPurchase->proof_of_payment = json_encode($proofOfPaymentsLocations);
        $gemPurchase->update();

        return response()->json([
            'proof_of_payment' => $gemPurchase['proof_of_payment']
        ]);
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
        $request->validate([
            'items' => 'required',
            'stockist' => 'required|numeric', // 0 => is not a stockist, 1 => is a mobile stockist, 2 => is a center stockist
            'full_name' => 'required',
            'contact_number' => 'required',
            'barangay' => 'required',
            'city' => 'required',
            'province' => 'required',
            'zip_code' => 'required',
        ]);

        $this->processOrder(Auth::user(), $request->items, $request->stockist, $request->full_name, $request->contact_number, $request->barangay, $request->city, $request->province, $request->zip_code, $request->terminal_user);

        return response()->json();
    }

    public function processOrder($user, $requestItems, $requestStockist, $requestFullName, $requestContactNumber, $requestBarangay, $requestCity, $requestProvince, $requestZipCode, $requestTerminalUser) {
        $items = json_decode($requestItems, true);
        if(count($items) == 0) {
            abort(422, "You haven't added any items to your cart.");
        }

        $isTerminalUser = false;

        if($requestTerminalUser == '0') {
            $purchaser = $user;

            if(!(($purchaser["stockist"] == 2 && $requestStockist == 2) || ($purchaser["stockist"] == 2 && $requestStockist == 0) || ($purchaser["stockist"] == 1 && $requestStockist == 1) || ($purchaser["stockist"] == 1 && $requestStockist == 0) || $purchaser["stockist"] == 0)) {
                abort(422, "Your account has no privilege for this purchase.");
            }
        } else {
            if($user->stockist > 0) {
                $terminalUser = User::find(base64_decode($requestTerminalUser));

                if($terminalUser) {
                    $purchaser = $terminalUser;
                    $isTerminalUser = true;
                } else {
                    abort(422, "Invalid Purchaser");
                }
            } else {
                abort(422, "You have no privilege to access the terminal.");
            }
        }

        $terminalUser = ($isTerminalUser) ? $user : null;

        if($requestStockist == 1) {
            $terminalUser = $purchaser->stockistAssignment->stockistUser;
        } else if($requestStockist == 2) {
            $terminalUser = null;
        }

        $totalPrice = 0;
        $totalPointsValue = 0;
        $lessInStock = 0;

        $winnersGemValue = winnersGemValue();

        for($i = 0; $i < count($items); $i++) {
            if($requestStockist == 1) {
                $price = "mobile_price";
            } else if($requestStockist == 2) {
                $price = "center_price";
            } else {
                $price = ($purchaser['rank'] > 0) ? "distributors_price" : "suggested_retail_price";
            }

            $itemDetails = Item::find($items[$i]['id']);

            // 1 => package, 2 => product
            $type = $itemDetails["type"];

            $items[$i]['price'] = $itemDetails[$price] / $winnersGemValue;
            $items[$i]['points_value'] = $itemDetails["points_value"];

            $totalPrice += $items[$i]['quantity'] * $items[$i]['price'];
            $totalPointsValue += $items[$i]['quantity'] * $items[$i]['points_value'];

            // If purchased by a stockist but not a center stockist, stock is checked
            if($isTerminalUser && $requestStockist != 2) {
                $itemStock = $itemDetails->terminalItemStock($terminalUser);

                if($itemStock["inStock"] < $items[$i]['quantity']) {
                    $lessInStock++;
                }
            }
        }

        if($isTerminalUser && $requestStockist != 2) { // if purchased by a stockist but not a center stockist, stock is checked
            abort_if($lessInStock > 0, 422, $lessInStock . " of the items to be ordered " . (($lessInStock > 1) ? "are" : "is") . " less in stock.");
        }

        if($requestStockist) {
            $type = 2;
        }

        if($isTerminalUser) {
            $terminalWinnersGem = $terminalUser->terminalWinnersGem();
            abort_if($terminalWinnersGem["balance"] < $totalPointsValue, 422, "Insufficient Winners Gem");
        } else {
            $income = $purchaser->income();
            abort_if($income["gemBalance"] < $totalPrice, 422, "Insufficient Winners Gem");
        }

        do {
            $referenceCode = generateCode(8);
            $codeExists = Order::where('reference', 'LIKE', $referenceCode)
                ->first();
        } while ($codeExists);

        // If purchaser is not a stockist
        if($requestStockist == 0) {
            // If the item is a package, pool share is the total points value, else, just 10%
            $poolShare = ($type == 1) ? $totalPointsValue : $totalPointsValue * 0.1;
        } else {
            $poolShare = 0;
        }

        $order = new Order();
        $order->type = $type;
        $order->stockist = $requestStockist;
        $order->reference = $referenceCode;
        $order->user_id = $purchaser['id'];
        $order->price = $totalPrice;
        $order->points_value = $totalPointsValue;
        $order->pool_share = $poolShare;
        $order->full_name = $requestFullName;
        $order->contact_number = $requestContactNumber;
        $order->barangay = $requestBarangay;
        $order->city = $requestCity;
        $order->province = $requestProvince;
        $order->zip_code = $requestZipCode;
        $order->terminal_user_id = ($terminalUser) ? $terminalUser['id'] : 0;
        $order->save();

        for($i = 0; $i < count($items); $i++) {
            $orderedItem = new OrderedItem();
            $orderedItem->order_id = $order['id'];
            $orderedItem->item_id = $items[$i]['id'];
            $orderedItem->quantity = $items[$i]['quantity'];
            $orderedItem->price = $items[$i]['price'];
            $orderedItem->points_value = $items[$i]['points_value'];
            $orderedItem->save();
        }

        if($requestStockist == 0) {
            if($type == 1 && $purchaser['id'] > 1) { // Package Purchase
                if($purchaser['rank'] == 0) {
                    $purchaser['rank'] = 1;
                    $purchaser->update();
                }

                $packageId = $purchaser["package_id"];

                $item = Item::find($orderedItem['item_id']);

                $purchasedPackage = $item['package_id'];

                // Packages Order: 0 -> (4 / 5) -> (2 / 6) -> (1 / 3)
                $isFromFreeAccountUpgrade = $packageId == 0;
                $isFromDreamMakerUpgrade = ($packageId == 4 || $packageId == 5) && ($purchasedPackage == 2 || $purchasedPackage == 6 || $purchasedPackage == 1 || $purchasedPackage == 3);
                $isFromDreamStarterUpgrade = ($packageId == 2 || $packageId == 6) && ($purchasedPackage == 1 || $purchasedPackage == 3);

                if ($isFromFreeAccountUpgrade || $isFromDreamMakerUpgrade || $isFromDreamStarterUpgrade) {
                    $packageId = $purchasedPackage;

                    $purchaser->package_id = $purchasedPackage;
                    $purchaser->update();
                }

                $downline = Downline::where('level', 1)
                    ->where('upline', $purchaser["sponsor"])
                    ->where('downline', $purchaser['id'])
                    ->first();

                if (!$downline) {
                    // Downline Ranks
                    $upline = $purchaser["sponsor"];
                    $downline = $purchaser['id'];
                    $level = 1;

                    $directs = Downline::where('level', 1)
                        ->where('upline', $upline)
                        ->get();

                    foreach ($directs as $i => $direct) {
                        if ($direct["downline"] == $downline) {
                            break;
                        }
                    }

                    $newDownline = new Downline();
                    $newDownline->upline = $upline;
                    $newDownline->downline = $purchaser['id'];
                    $newDownline->leg = $i + 1;
                    $newDownline->level = $level++;
                    $newDownline->save();

                    $downline = $upline;

                    $upline = Downline::where('level', 1)
                        ->where('downline', $downline)
                        ->first();

                    while($upline) {
                        $directs = Downline::where('level', 1)
                            ->where('upline', $upline["upline"])
                            ->get();

                        foreach ($directs as $i => $direct) {
                            if ($direct["downline"] == $downline) {
                                break;
                            }
                        }

                        $newDownline = new Downline();
                        $newDownline->upline = $upline["upline"];
                        $newDownline->downline = $purchaser['id'];
                        $newDownline->leg = $i + 1;
                        $newDownline->level = $level++;
                        $newDownline->save();

                        $downline = $upline["upline"];

                        $upline = Downline::where('level', 1)
                            ->where('downline', $downline)
                            ->first();
                    }
                }

                $this->processReferralIncome($purchaser, $order, $packageId);
                $this->processInfinityPlusIncome($purchaser, $order, $packageId);
            } else if($type == 2) { // Product Purchase
                $this->processPersonalRebateIncome($purchaser, $order);

                if($purchaser['id'] > 1) {
                    $this->processIncomeDueToMonthlyPVChange($purchaser);
                    $this->processUnilevelIncome($purchaser, $order);
                    $this->processStairstepIncome($purchaser, $order);
                }
            }

            $rankPoints = new RankPoint();
            $rankPoints->user_id = $purchaser['id'];
            $rankPoints->order_id = $order['id'];
            $rankPoints->points_value = $totalPointsValue;
            $rankPoints->save();

            $this->checkForRankPromotion($purchaser);

            $upline = User::select('users.*')
                ->join('downlines', function($join) use ($purchaser) {
                    $join->on('users.id', 'upline');
                    $join->where('downline', $purchaser['id']);
                    $join->where('level', 1);
                })
                ->first();

            while($upline) {
                if ($type == 1 && $upline["package_id"] == 2 && isset($packageId) && $packageId == 1) {
                    $rankPoints = 25;
                } else {
                    $rankPoints = $totalPointsValue;
                }

                $newRankPoints = new RankPoint();
                $newRankPoints->user_id = $upline["id"];
                $newRankPoints->order_id = $order['id'];
                $newRankPoints->points_value = $rankPoints;
                $newRankPoints->save();

                $this->checkForRankPromotion($purchaser);

                $upline = User::select('users.*')
                    ->join('downlines', function($join) use ($upline) {
                        $join->on('users.id', 'upline');
                        $join->where('downline', $upline['id']);
                        $join->where('level', 1);
                    })
                    ->first();
            }
        }
    }

    public function processReferralIncome(User $purchaser, Order $order, $packageId) {
        $dreamMakerIncome = array(50, 10, 10, 10, 10, 5, 5, 5);
        $dreamStarterIncome = array(150, 40, 40, 40, 40, 25, 25, 25);
        $dreamBuilderIncome = array(300, 75, 75, 75, 75, 25, 25, 25);
        $fairwinDreamIncome = array(500, 20, 20, 20, 20, 10, 10, 10);
        $fairwinStarterIncome = array(150, 30, 30, 30, 30, 10, 10, 10);
        $fairwinPowerIncome = array(300, 75, 75, 75, 75, 30, 30, 30);

        $downline = $purchaser['id'];

        $referralIncomes = [];

        $referralUplines = [];
        for ($i = 1; $i <= count($dreamMakerIncome); $i++) {
            $upline = User::select('users.*')
                ->join('downlines', function($join) use ($downline) {
                    $join->on('users.id', 'upline');
                    $join->where('downline', $downline);
                    $join->where('level', 1);
                })
                ->first();

            if($upline) {
                $referralUplines[] = $upline;
                $uplinePackageId = $upline['package_id'];
                $upline = $upline['id'];
            } else {
                break;
            }

            if($packageId == 4) {
                $amount = $dreamMakerIncome[$i - 1];
            } else if($packageId == 2) {
                $amount = $dreamStarterIncome[$i - 1];
            } else if($packageId == 1) {
                $amount = $dreamBuilderIncome[$i - 1];
            } else if($packageId == 3) {
                $amount = $fairwinDreamIncome[$i - 1];
            } else if($packageId == 5) {
                $amount = $fairwinStarterIncome[$i - 1];
            } else if($packageId == 6) {
                $amount = $fairwinPowerIncome[$i - 1];
            }

            if($uplinePackageId == 4 || $uplinePackageId == 5) {
                $referralIncomes[] = [
                    'order_id' => $order['id'],
                    'upline' => $upline,
                    'downline' => $purchaser['id'],
                    'level' => $i,
                    'amount' => $amount * 0.7,
                    'dream_maker_percentage' => 0.7,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];

                $dspFppDbpFdpUpline = Downline::select('upline')
                    ->join('users', function($join) {
                        $join->on('upline', 'users.id');
                        $join->where('package_id', 1);
                        $join->orWhere('package_id', 2);
                        $join->orWhere('package_id', 3);
                        $join->orWhere('package_id', 6);
                    })
                    ->where('downline', $upline)
                    ->orderBy('level')
                    ->first();

                if($dspFppDbpFdpUpline) {
                    $referralIncomes[] = [
                        'order_id' => $order['id'],
                        'upline' => $dspFppDbpFdpUpline['upline'],
                        'downline' => $purchaser['id'],
                        'level' => $i,
                        'amount' => $amount * 0.3,
                        'dream_maker_percentage' => 0.3,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ];
                }
            } else {
                $referralIncomes[] = [
                    'order_id' => $order['id'],
                    'upline' => $upline,
                    'downline' => $purchaser['id'],
                    'level' => $i,
                    'amount' => $amount,
                    'dream_maker_percentage' => 0,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];
            }

            $downline = $upline;
        }

        if(count($referralIncomes) > 0) {
            ReferralIncome::insert($referralIncomes);
        }

        foreach($referralUplines as $referralUpline) {
            $this->automaticFdpUpgrade($referralUpline);
        }
    }

    public function processInfinityPlusIncome(User $purchaser, Order $order, $packageId) {
        $uplinesRank2 = User::select('upline', 'rank', 'level')
            ->join('downlines', function($query) use ($purchaser) {
                $query->on('users.id', 'upline');
                $query->where('downline', $purchaser['id']);
            })
            ->where('rank', 2)
            ->limit(2);

        $uplinesRank3 = User::select('upline', 'rank', 'level')
            ->join('downlines', function($query) use ($purchaser) {
                $query->on('users.id', 'upline');
                $query->where('downline', $purchaser['id']);
            })
            ->where('rank', 3)
            ->limit(2);

        $uplinesRank4 = User::select('upline', 'rank', 'level')
            ->join('downlines', function($query) use ($purchaser) {
                $query->on('users.id', 'upline');
                $query->where('downline', $purchaser['id']);
            })
            ->where('rank', 4)
            ->limit(2);

        $uplinesRank5 = User::select('upline', 'rank', 'level')
            ->join('downlines', function($query) use ($purchaser) {
                $query->on('users.id', 'upline');
                $query->where('downline', $purchaser['id']);
            })
            ->where('rank', 5)
            ->limit(2);

        $uplinesRank6 = User::select('upline', 'rank', 'level')
            ->join('downlines', function($query) use ($purchaser) {
                $query->on('users.id', 'upline');
                $query->where('downline', $purchaser['id']);
            })
            ->where('rank', 6)
            ->limit(2);

        $uplinesRank7 = User::select('upline', 'rank', 'level')
            ->join('downlines', function($query) use ($purchaser) {
                $query->on('users.id', 'upline');
                $query->where('downline', $purchaser['id']);
            })
            ->where('rank', 7)
            ->limit(2);

        $uplinesRank8 = User::select('upline', 'rank', 'level')
            ->join('downlines', function($query) use ($purchaser) {
                $query->on('users.id', 'upline');
                $query->where('downline', $purchaser['id']);
            })
            ->where('rank', 8)
            ->limit(2);

        $uplinesRank9 = User::select('upline', 'rank', 'level')
            ->join('downlines', function($query) use ($purchaser) {
                $query->on('users.id', 'upline');
                $query->where('downline', $purchaser['id']);
            })
            ->where('rank', 9)
            ->limit(1);

        $uplines = $uplinesRank2->unionAll($uplinesRank3)
            ->unionAll($uplinesRank4)
            ->unionAll($uplinesRank5)
            ->unionAll($uplinesRank6)
            ->unionAll($uplinesRank7)
            ->unionAll($uplinesRank8)
            ->unionAll($uplinesRank9)
            ->orderBy('level')
            ->get()
            ->toArray();

        for($i = 0; $i < count($uplines); $i++) {
            if($i == 0) {
                $currentRank = $uplines[$i]["rank"];
                $i++;
            }

            if($i < count($uplines)) {
                if($uplines[$i]["rank"] < $currentRank) {
                    array_splice($uplines, $i, 1);
                    $i = -1;
                } else {
                    $currentRank = $uplines[$i]["rank"];
                }
            } else {
                break;
            }
        }

        if($packageId == 3) { // FDP Entry
            $infinityPlusIncome = array(0, 0, 60, 120, 180, 240, 300, 330, 360, 390);
        } else if($packageId == 2) { // DSP Entry
            $infinityPlusIncome = array(0, 0, 40, 80, 120, 160, 200, 240, 280, 320);
        } else if($packageId == 6) { // FPP Entry
            $infinityPlusIncome = array(0, 0, 50, 100, 150, 200, 250, 280, 320, 350);
        } else if($packageId == 4) { // DMP Entry
            $infinityPlusIncome = array(0, 0, 10, 20, 30, 40, 50, 60, 70, 80);
        } else { // FSP
            $infinityPlusIncome = array(0, 0, 10, 20, 30, 40, 50, 60, 70, 80);
        }

        $infinityPlusIncomes = [];

        foreach ($uplines as $key => $upline) {
            if($key >= 1 && $upline['rank'] == $uplines[$key - 1]["rank"] && $upline['rank'] <= 9) {
                $amount = $infinityPlusIncome[$upline['rank'] + 1] * 0.5;
                $minusLower = $infinityPlusIncome[$upline['rank'] + 1] * 0.5;
            } else {
                $amount = $infinityPlusIncome[$upline['rank']];
                $minusLower = $infinityPlusIncome[$upline['rank']];
            }

            $infinityPlusIncomes[] = [
                'order_id' => $order['id'],
                'upline' => $upline['upline'],
                'downline' => $purchaser['id'],
                'level' => $upline['level'],
                'amount' => $amount,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];

            for ($i = $upline['rank'] + 1; $i < count($infinityPlusIncome); $i++) {
                $infinityPlusIncome[$i] = $infinityPlusIncome[$i] - $minusLower;
            }
        }

        if(count($infinityPlusIncomes) > 0) {
            InfinityPlusIncome::insert($infinityPlusIncomes);
        }
    }

    public function processPersonalRebateIncome(User $purchaser, Order $order) {
        if($purchaser["rank"] >= 1) {
            $personalRebatePercentages = array(0, 0.1, 0.2, 0.3, 0.4, 0.5, 0.6, 0.6, 0.6, 0.6);

            if($purchaser['package_id'] == 4) {
                $personalRebateIncome = new PersonalRebateIncome();
                $personalRebateIncome->order_id = $order['id'];
                $personalRebateIncome->user_id = $purchaser['id'];
                $personalRebateIncome->amount = $order['points_value'] * $personalRebatePercentages[$purchaser["rank"]] * 0.7;
                $personalRebateIncome->dream_maker_percentage = 0.7;
                $personalRebateIncome->save();

                $dspDbpFdpUpline = Downline::select('upline')
                    ->join('users', 'upline', 'users.id')
                    ->where('downline', $purchaser['id'])
                    ->where(function($query) {
                        $query->where('package_id', 1);
                        $query->orWhere('package_id', 2);
                        $query->orWhere('package_id', 3);
                    })
                    ->orderBy('level')
                    ->first();

                if($dspDbpFdpUpline) {
                    $personalRebateIncome = new PersonalRebateIncome();
                    $personalRebateIncome->order_id = $order['id'];
                    $personalRebateIncome->user_id = $dspDbpFdpUpline['upline'];
                    $personalRebateIncome->amount = $order['points_value'] * $personalRebatePercentages[$purchaser["rank"]] * 0.3;
                    $personalRebateIncome->dream_maker_percentage = 0.3;
                    $personalRebateIncome->save();
                }
            } else {
                $personalRebateIncome = new PersonalRebateIncome();
                $personalRebateIncome->order_id = $order['id'];
                $personalRebateIncome->user_id = $purchaser['id'];
                $personalRebateIncome->amount = $order['points_value'] * $personalRebatePercentages[$purchaser["rank"]];
                $personalRebateIncome->dream_maker_percentage = 0;
                $personalRebateIncome->save();
            }

            $this->automaticFdpUpgrade($purchaser);
        }
    }

    public function processUnilevelIncome(User $purchaser, Order $order) {
        $unilevelIncome = array(0.05, 0.05, 0.05, 0.05, 0.05, 0.03, 0.03, 0.03);
        $downline = $purchaser['id'];
        $unilevelIncomes = [];

        $referralUplines = [];
        for ($i = 1; $i <= count($unilevelIncome); $i++) {
            $upline = User::select('users.*')
                ->join('downlines', function($join) use ($downline) {
                    $join->on('users.id', 'upline');
                    $join->where('downline', $downline);
                    $join->where('level', 1);
                })
                ->first();

            if($upline) {
                $referralUplines[] = $upline;
                $uplinePackageId = $upline['package_id'];
                $monthlyPVMaintenance = $upline->monthlyPVMaintenance();
                $upline = $upline['id'];
            } else {
                break;
            }

            if($uplinePackageId == 4) {
                $received = ($monthlyPVMaintenance["points"] >= 50 || in_array($upline, $this->exemptedAccounts())) ? 1 : 0;
            } else {
                $received = ($monthlyPVMaintenance["points"] >= 100 || in_array($upline, $this->exemptedAccounts())) ? 1 : 0;
            }

            $amount = $order['points_value'] * $unilevelIncome[$i - 1];

            if($uplinePackageId == 4) {
                $unilevelIncomes[] = [
                    'order_id' => $order['id'],
                    'upline' => $upline,
                    'downline' => $purchaser['id'],
                    'level' => $i,
                    'amount' => $amount * 0.7,
                    'received' => $received,
                    'dream_maker_percentage' => 0.7,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];

                $dspDbpDcpUpline = Downline::select('upline')
                    ->join('users', 'upline', 'users.id')
                    ->where('downline', $purchaser['id'])
                    ->where(function($query) {
                        $query->where('package_id', 1);
                        $query->orWhere('package_id', 2);
                        $query->orWhere('package_id', 3);
                    })
                    ->orderBy('level')
                    ->first();

                if($dspDbpDcpUpline) {
                    $unilevelIncomes[] = [
                        'order_id' => $order['id'],
                        'upline' => $dspDbpDcpUpline['upline'],
                        'downline' => $purchaser['id'],
                        'level' => $i,
                        'amount' => $amount * 0.3,
                        'received' => $received,
                        'dream_maker_percentage' => 0.3,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ];
                }
            } else {
                $unilevelIncomes[] = [
                    'order_id' => $order['id'],
                    'upline' => $upline,
                    'downline' => $purchaser['id'],
                    'level' => $i,
                    'amount' => $amount,
                    'received' => $received,
                    'dream_maker_percentage' => 0,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];
            }

            $downline = $upline;
        }

        if (count($unilevelIncomes) > 0) {
            UnilevelIncome::insert($unilevelIncomes);
        }

        foreach($referralUplines as $referralUpline) {
            $this->automaticFdpUpgrade($referralUpline);
        }
    }

    public function processStairstepIncome(User $purchaser, Order $order) {
        if($purchaser["rank"] <= 6) {
            $uplinesRank2 = User::select('upline', 'rank', 'level')
                ->join('downlines', function($query) use ($purchaser) {
                    $query->on('users.id', 'upline');
                    $query->where('downline', $purchaser['id']);
                })
                ->where('rank', 2)
                ->limit(2);

            $uplinesRank3 = User::select('upline', 'rank', 'level')
                ->join('downlines', function($query) use ($purchaser) {
                    $query->on('users.id', 'upline');
                    $query->where('downline', $purchaser['id']);
                })
                ->where('rank', 3)
                ->limit(2);

            $uplinesRank4 = User::select('upline', 'rank', 'level')
                ->join('downlines', function($query) use ($purchaser) {
                    $query->on('users.id', 'upline');
                    $query->where('downline', $purchaser['id']);
                })
                ->where('rank', 4)
                ->limit(2);

            $uplinesRank5 = User::select('upline', 'rank', 'level')
                ->join('downlines', function($query) use ($purchaser) {
                    $query->on('users.id', 'upline');
                    $query->where('downline', $purchaser['id']);
                })
                ->where('rank', 5)
                ->limit(2);

            $uplinesRank6 = User::select('upline', 'rank', 'level')
                ->join('downlines', function($query) use ($purchaser) {
                    $query->on('users.id', 'upline');
                    $query->where('downline', $purchaser['id']);
                })
                ->where('rank', 6)
                ->limit(2);

            $uplinesRank7 = User::select('upline', 'rank', 'level')
                ->join('downlines', function($query) use ($purchaser) {
                    $query->on('users.id', 'upline');
                    $query->where('downline', $purchaser['id']);
                })
                ->where('rank', 7)
                ->limit(2);

            $uplinesRank8 = User::select('upline', 'rank', 'level')
                ->join('downlines', function($query) use ($purchaser) {
                    $query->on('users.id', 'upline');
                    $query->where('downline', $purchaser['id']);
                })
                ->where('rank', 8)
                ->limit(2);

            $uplinesRank9 = User::select('upline', 'rank', 'level')
                ->join('downlines', function($query) use ($purchaser) {
                    $query->on('users.id', 'upline');
                    $query->where('downline', $purchaser['id']);
                })
                ->where('rank', 9)
                ->limit(1);

            $uplines = $uplinesRank2->unionAll($uplinesRank3)
                ->unionAll($uplinesRank4)
                ->unionAll($uplinesRank5)
                ->unionAll($uplinesRank6)
                ->unionAll($uplinesRank7)
                ->unionAll($uplinesRank8)
                ->unionAll($uplinesRank9)
                ->where('rank', '>=', $purchaser["rank"])
                ->orderBy('level')
                ->get()
                ->toArray();

            for($i = 0; $i < count($uplines); $i++) {
                if($i == 0) {
                    $currentRank = $uplines[$i]["rank"];
                    $i++;
                }

                if($i < count($uplines)) {
                    if($uplines[$i]["rank"] < $currentRank) {
                        array_splice($uplines, $i, 1);
                        $i = -1;
                    } else {
                        $currentRank = $uplines[$i]["rank"];
                    }
                } else {
                    break;
                }
            }

            if(count($uplines) >= 2 && $purchaser["rank"] == $uplines[0]["rank"] && $uplines[0]["rank"] == $uplines[1]["rank"]) {
                array_splice($uplines, 1, 1);
            }

            $unsetUplines = false;
            for($i = 0; $i < count($uplines); $i++) {
                if($unsetUplines) {
                    array_splice($uplines, $i--, 1);
                }

                if(!$unsetUplines && $uplines[$i]["rank"] >= 6) {
                    $uplines[$i]["rank"] = 6;
                    $unsetUplines = true;
                }
            }

            if (count($uplines) > 0) {
                $stairstepIncome = array(0, 0, 0.1, 0.2, 0.3, 0.4, 0.5, 0.55, 0.60, 0.65);
                $minusLower = $stairstepIncome[$purchaser["rank"]];
                for ($i = 0; $i < count($stairstepIncome); $i++) {
                    $stairstepIncome[$i] -= $minusLower;
                }

                $stairstepIncomes = [];

                foreach ($uplines as $key => $upline) {
                    if (($upline["rank"] == $purchaser["rank"] || ($key >= 1 && $upline['rank'] == $uplines[$key - 1]["rank"])) && $upline['rank'] < 6) {
                        $amount = ($order['points_value'] * $stairstepIncome[$upline['rank'] + 1]) * 0.5;
                        $minusLower = $stairstepIncome[$upline['rank'] + 1] * 0.5;
                    } else {
                        $amount = $order['points_value'] * $stairstepIncome[$upline['rank']];
                        $minusLower = $stairstepIncome[$upline['rank']];
                    }

                    $monthlyPVMaintenance = User::find($upline['upline'])->monthlyPVMaintenance();
                    $received = (($upline['rank'] >= 2 && $upline['rank'] <= 5 && $monthlyPVMaintenance["points"] >= 200) || ($upline['rank'] == 6 && $monthlyPVMaintenance["points"] >= 300) || ($upline['rank'] >= 7 && $upline['rank'] <= 9 && $monthlyPVMaintenance["points"] >= 500) || in_array($upline['upline'], $this->exemptedAccounts())) ? 1 : 0;

                    $stairstepIncomes[] = [
                        'order_id' => $order['id'],
                        'upline' => $upline['upline'],
                        'downline' => $purchaser['id'],
                        'level' => $upline['level'],
                        'amount' => $amount,
                        'received' => $received,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ];

                    for ($i = $upline['rank'] + 1; $i < count($stairstepIncome); $i++) {
                        $stairstepIncome[$i] = $stairstepIncome[$i] - $minusLower;
                    }
                }

                if(count($stairstepIncomes) > 0) {
                    StairstepIncome::insert($stairstepIncomes);
                }
            }
        }
    }

    public function processIncomeDueToMonthlyPVChange(User $purchaser) {
        $monthlyPVMaintenance = $purchaser->monthlyPVMaintenance();

        if($monthlyPVMaintenance >= 100) {
            UnilevelIncome::where('upline', $purchaser['id'])
                ->where('created_at', '>=', Carbon::now()->format('Y-m-01 00:00:00'))
                ->where('created_at', '<=', Carbon::now()->format('Y-m-t 23:59:59'))
                ->update([
                    'received' => 1
                ]);

            if(($purchaser['rank'] >= 2 && $purchaser['rank'] <= 5 && $monthlyPVMaintenance >= 200) || ($purchaser['rank'] == 6 && $monthlyPVMaintenance >= 300) || ($purchaser['rank'] >= 7 && $purchaser['rank'] <= 9 && $monthlyPVMaintenance >= 500)) {
                StairstepIncome::where('upline', $purchaser['id'])
                    ->where('created_at', '>=', Carbon::now()->format('Y-m-01 00:00:00'))
                    ->where('created_at', '<=', Carbon::now()->format('Y-m-t 23:59:59'))
                    ->update([
                        'received' => 1
                    ]);
            }

            $this->automaticFdpUpgrade($purchaser);
        }
    }

    public function automaticFdpUpgrade(User $user) {
        // if a Dealer with Dream Starter Package earned an amount equivalent to the price of

        if($user['rank'] == 1 && $user['package_id'] == 2) {
            $fairwinDreamPackagePrice = fairwinDreamPackagePrice();
            $fairwinDreamPackagePriceInPeso = $fairwinDreamPackagePrice * winnersGemValue();

            $income = $user->income();

            if($income["pesoBalance"] >= $fairwinDreamPackagePriceInPeso) {
                $conversion = new Conversion();
                $conversion->user_id = $user['id'];
                $conversion->type = 2;
                $conversion->gem = $fairwinDreamPackagePrice;
                $conversion->peso = $fairwinDreamPackagePriceInPeso;
                $conversion->save();

                $previousOrder = $user->orders()
                    ->where('type', 1)
                    ->first();

                $this->processOrder($user, json_encode(["id" => 21, "quantity" => 1]), 0, $previousOrder["full_name"], $previousOrder["contact_number"], $previousOrder["barangay"], $previousOrder["city"], $previousOrder["province"], $previousOrder["zip_code"], '0');
            }
        }
    }

    public function exemptedAccounts() {
        return array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13);
    }

    public function checkForRankPromotion(User $user) {
        $totalRankPoints = $user->totalRankPoints();
        $directCount = $user->directCount();

        $isPromoted = false;

        if ($totalRankPoints >= 10000 && $totalRankPoints < 50000 && $user['rank'] == 1 && ($user["package_id"] == 1 || $user["package_id"] == 3)) {
            $isPromoted = ($directCount >= 5);
        } else if ($totalRankPoints >= 50000 && $totalRankPoints < 200000 && ($user['rank'] >= 1 && $user['rank'] <= 2)) {
            $explorerLegCount = $user->rankLegCount(2);

            $isPromoted = ($directCount >= 5 && $explorerLegCount >= 2);
        } else if ($totalRankPoints >= 200000 && $totalRankPoints < 600000 && ($user['rank'] >= 1 && $user['rank'] <= 3)) {
            $pathfinderLegCount = $user->rankLegCount(3);
            $explorerLegCount = $user->rankLegCount(2);

            $isPromoted = ($directCount >= 5 && ($pathfinderLegCount >= 2 || ($pathfinderLegCount >= 1 && $explorerLegCount >= 3)));
        } else if ($totalRankPoints >= 600000 && $totalRankPoints < 1500000 && ($user['rank'] >= 1 && $user['rank'] <= 4)) {
            $navigatorLegCount = $user->rankLegCount(4);
            $pathfinderLegCount = $user->rankLegCount(3);

            $isPromoted = ($directCount >= 5 && ($navigatorLegCount >= 2 || ($navigatorLegCount >= 1 && $pathfinderLegCount >= 3)));
        } else if ($totalRankPoints >= 1500000 && ($user['rank'] >= 1 && $user['rank'] <= 5)) {
            $masterGuideLegCount = $user->rankLegCount(5);

            $isPromoted = ($directCount >= 5 && $masterGuideLegCount >= 2);
        } else if ($totalRankPoints >= 1500000 && ($user['rank'] >= 1 && $user['rank'] <= 6)) {
            $fairWinnerLegCount = $user->rankLegCount(6);

            $isPromoted = ($directCount >= 5 && $fairWinnerLegCount >= 1);
        } else if ($totalRankPoints >= 1500000 && ($user['rank'] >= 1 && $user['rank'] <= 7)) {
            $fairWinnerLegCount = $user->rankLegCount(6);

            $isPromoted = ($directCount >= 5 && $fairWinnerLegCount >= 2);
        } else if ($totalRankPoints >= 1500000 && ($user['rank'] >= 1 && $user['rank'] <= 8)) {
            $fairWinnerLegCount = $user->rankLegCount(6);

            $isPromoted = ($directCount >= 5 && $fairWinnerLegCount >= 3);
        }

        if ($isPromoted) {
            $user->rank = $user['rank'] + 1;
            $user->update();

            if($user['rank'] >= 2 && $user['rank'] <= 6) {
                $rankIncentiveIncomes = [0, 0, 1000, 5000, 15000, 30000, 50000];

                $rankIncentiveIncome = new RankIncentiveIncome();
                $rankIncentiveIncome->user_id = $user['id'];
                $rankIncentiveIncome->rank = $user['rank'];
                $rankIncentiveIncome->amount = $rankIncentiveIncomes[$user['rank']];
                $rankIncentiveIncome->save();
            }
        }
    }

    public function markOrderAsComplete(Request $request) {
        $request->validate([
            'id' => 'required|numeric',
            'from' => 'required|in:terminal,admin',
        ]);

        $order = Order::where('id', $request->id)
            ->whereNull('date_time_completed')
            ->first();

        abort_if(!$order, 422, 'Invalid Order');

        if($request->from == 'terminal') {
            $items = $order->items();

            $lessInStock = 0;
            $totalPoints = 0;

            foreach($items as $item) {
                $itemStock = $item->terminalItemStock(Auth::user());

                if($itemStock["inStock"] < $item["quantity"]) {
                    $lessInStock++;
                }

                $totalPoints += $item["quantity"] * $item["points_value"];
            }

            abort_if($lessInStock > 0, 422, $lessInStock . " of the items ordered " . (($lessInStock > 1) ? "are" : "is") . " less in stock.");

            $terminalWinnersGem = Auth::user()->terminalWinnersGem();

            abort_if($terminalWinnersGem["balance"] < $totalPoints, 422, 'Your Terminal has insufficient Winners Gem.');
        }

        $order->date_time_completed = Carbon::now();
        $order->update();

        if($request->from == 'admin') {
            [$orders, $stockists, $stockistLabels] = (new AdminOrderController())->getData();

            return response()->json([
                'content' => (string)view('admin.orders.includes.ordersTable', compact('orders', 'stockists', 'stockistLabels'))
            ]);
        } else {
            $orders = (new TerminalController())->ordersAsATerminalData();
            $terminalWinnersGem = Auth::user()->terminalWinnersGem();

            return response()->json([
                'content' => (string)view('terminal.includes.ordersTable', compact('orders')),
                'terminalWinnersGem' => number_format(Auth::user()->terminalWinnersGem()["balance"], 2)
            ]);
        }
    }
}
