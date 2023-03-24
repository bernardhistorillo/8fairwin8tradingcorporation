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
            'terminal_account' => 'required',
            'full_name' => 'required',
            'contact_number' => 'required',
            'barangay' => 'required',
            'city' => 'required',
            'zip_code' => 'required',
        ]);

        $items = $request->items;
        if(count($request->items) == 0) {
            abort(422, "You haven't added any items to your cart.");
        }

        if(count($items) > 0) {
            $terminalUser = null;

            if($request->terminal_account == 0) {
                $purchaser = Auth::user();

                if(!(($purchaser["stockist"] == 2 && $request->stockist == 2) || ($purchaser["stockist"] == 2 && $request->stockist == 0) || ($purchaser["stockist"] == 1 && $request->stockist == 1) || ($purchaser["stockist"] == 1 && $request->stockist == 0) || $purchaser["stockist"] == 0)) {
                    abort(422, "Your account has no privilege for this purchase.");
                }
            } else {
                if(Auth::user()->stockist > 0) {
                    $terminalUser = User::find(base64_decode($request->terminal_account));
                    if($terminalUser) {
                        $purchaser = $terminalUser;
                    } else {
                        abort(422, "Invalid Purchaser");
                    }
                } else {
                    abort(422, "You have no privilege to access the terminal.");
                }
            }

            if($request->stockist == 1) {
                $terminalUser = $purchaser->stockistAssignment->stockistUser;
            } else if($request->stockist == 2) {
                $terminalUser = null;
            }

            $totalPrice = 0;
            $totalPointsValue = 0;
            $lessInStock = 0;

            $winnersGemValue = winnersGemValue();

            for($i = 0; $i < count($items); $i++) {
                if($request->stockist == 1) {
                    $price = "mobile_price";
                } else if($request->stockist == 2) {
                    $price = "center_price";
                } else {
                    $price = ($purchaser['rank'] > 0) ? "distributors_price" : "suggested_retail_price";
                }

                $itemDetails = Item::find($items[$i]->id);

                // 1 => package, 2 => product
                $type = $itemDetails["type"];

                $items[$i]->price = $itemDetails[$price] / $winnersGemValue;
                $items[$i]->points_value = $itemDetails["points_value"];

                $totalPrice += $items[$i]->quantity * $items[$i]->price;
                $totalPointsValue += $items[$i]->quantity * $items[$i]->points_value;

                // If purchased by a stockist but not a center stockist, stock is checked
                if($terminalUser && $request->stockist != 2) {
                    $itemStock = $itemDetails->terminalItemStock($terminalUser['id'], $terminalUser['stockist']);

                    if($itemStock["in_stock"] < $items[$i]->quantity) {
                        $lessInStock++;
                    }
                }
            }

            abort_if($lessInStock > 0, 422, $lessInStock . " of the items to be ordered " . (($lessInStock > 1) ? "are" : "is") . " less in stock.");

            if($request->stockist) {
                $type = 2;
            }

            if($terminalUser) {
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
            if($request->stockist == 0) {
                // If the item is a package, pool share is the total points value, else, just 10%
                $poolShare = ($type == 1) ? $totalPointsValue : $totalPointsValue * 0.1;
            } else {
                $poolShare = 0;
            }

            $order = new Order();
            $order->type = $type;
            $order->stockist = $request->stockist;
            $order->reference = $referenceCode;
            $order->user_id = $purchaser['id'];
            $order->price = $totalPrice;
            $order->points_value = $totalPointsValue;
            $order->pool_share = $poolShare;
            $order->full_name = $request->full_name;
            $order->contact_number = $request->contact_number;
            $order->barangay = $request->barangay;
            $order->city = $request->city;
            $order->province = $request->province;
            $order->zip_code = $request->zip_code;
            $order->terminal_user_id = $terminalUser['id'];
            $order->save();

            for($i = 0; $i < count($items); $i++) {
                $orderedItem = new OrderedItem();
                $orderedItem->order_id = $order['id'];
                $orderedItem->item_id = $items[$i]->id;
                $orderedItem->quantity = $items[$i]->quantity;
                $orderedItem->price = $items[$i]->price;
                $orderedItem->points_value = $items[$i]->points_value;
                $orderedItem->save();
            }

            if($request->stockist == 0) {
                if($type == 1 && $purchaser['id'] > 1) { // Package Purchase
                    $itemId = $orderedItem['item_id'];
                    $packageId = $purchaser["package_id"];

                    $purchasedPackage = ($itemId == 21) ? 1 : (($itemId == 28) ? 4 : 2);

                    // Packages Order: 0 -> 4 -> 2 -> 1
                    $isFromFreeAccountUpgrade = $packageId == 0;
                    $isFromDreamMakerUpgrade = $packageId == 4 && ($purchasedPackage == 2 || $purchasedPackage == 1);
                    $isFromDreamStarterUpgrade = $packageId == 2 && ($purchasedPackage == 1);

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

                        // stairstep
                        if($purchaser["rank"] <= 6) {
                            $sql = $db->prepare("SELECT `upline`, `rank`, `level` FROM ( (SELECT `upline`, `rank`, `level` FROM `fw_downlines`, `fw_accounts` WHERE `downline` = ? AND `upline` = `fw_accounts`.`id` AND `rank` = 2 ORDER BY `level` ASC LIMIT 2) UNION ALL (SELECT `upline`, `rank`, `level` FROM `fw_downlines`, `fw_accounts` WHERE `downline` = ? AND `upline` = `fw_accounts`.`id` AND `rank` = 3 ORDER BY `level` ASC LIMIT 2) UNION ALL (SELECT `upline`, `rank`, `level` FROM `fw_downlines`, `fw_accounts` WHERE `downline` = ? AND `upline` = `fw_accounts`.`id` AND `rank` = 4 ORDER BY `level` ASC LIMIT 2) UNION ALL (SELECT `upline`, `rank`, `level` FROM `fw_downlines`, `fw_accounts` WHERE `downline` = ? AND `upline` = `fw_accounts`.`id` AND `rank` = 5 ORDER BY `level` ASC LIMIT 2) UNION ALL (SELECT `upline`, `rank`, `level` FROM `fw_downlines`, `fw_accounts` WHERE `downline` = ? AND `upline` = `fw_accounts`.`id` AND `rank` = 6 ORDER BY `level` ASC LIMIT 1) UNION ALL (SELECT `upline`, `rank`, `level` FROM `fw_downlines`, `fw_accounts` WHERE `downline` = ? AND `upline` = `fw_accounts`.`id` AND `rank` = 7 ORDER BY `level` ASC LIMIT 1) UNION ALL (SELECT `upline`, `rank`, `level` FROM `fw_downlines`, `fw_accounts` WHERE `downline` = ? AND `upline` = `fw_accounts`.`id` AND `rank` = 8 ORDER BY `level` ASC LIMIT 1) UNION ALL (SELECT `upline`, `rank`, `level` FROM `fw_downlines`, `fw_accounts` WHERE `downline` = ? AND `upline` = `fw_accounts`.`id` AND `rank` = 9 ORDER BY `level` ASC LIMIT 1) ) AS `table` WHERE `rank` >= ? ORDER BY `level` ASC");
                            if (!$sql->execute(array($purchaser['id'], $purchaser['id'], $purchaser['id'], $purchaser['id'], $purchaser['id'], $purchaser['id'], $purchaser['id'], $purchaser['id'], $purchaser["rank"]))) { error(""); }
                            $uplines = $sql->fetchAll(PDO::FETCH_ASSOC);

                            for($i = 0; $i < count($uplines); $i++) {
                                if($i == 0) {
                                    $current_rank = $uplines[$i]["rank"];
                                    $i++;
                                }

                                if($i < count($uplines)) {
                                    if($uplines[$i]["rank"] < $current_rank) {
                                        array_splice($uplines, $i, 1);
                                        $i = -1;
                                    } else {
                                        $current_rank = $uplines[$i]["rank"];
                                    }
                                } else {
                                    break;
                                }
                            }

                            if(count($uplines) >= 2 && $purchaser["rank"] == $uplines[0]["rank"] && $uplines[0]["rank"] == $uplines[1]["rank"]) {
                                array_splice($uplines, 1, 1);
                            }

                            $unset_uplines = false;
                            for($i = 0; $i < count($uplines); $i++) {
                                if($unset_uplines) {
                                    array_splice($uplines, $i--, 1);
                                }

                                if(!$unset_uplines && $uplines[$i]["rank"] >= 6) {
                                    $uplines[$i]["rank"] = 6;
                                    $unset_uplines = true;
                                }
                            }

                            if (count($uplines) > 0) {
                                $stairstep_income = array(0, 0, 0.1, 0.2, 0.3, 0.4, 0.5, 0.55, 0.60, 0.65);
                                $minus_lower = $stairstep_income[$purchaser["rank"]];
                                for ($i = 0; $i < count($stairstep_income); $i++) {
                                    $stairstep_income[$i] -= $minus_lower;
                                }

                                $statement = '';
                                $values = array();

                                foreach ($uplines as $key => $upline) {
                                    if (($upline["rank"] == $purchaser["rank"] || ($key >= 1 && $upline['rank'] == $uplines[$key - 1]["rank"])) && $upline['rank'] < 6) {
                                        $amount = ($totalPointsValue * $stairstep_income[$upline['rank'] + 1]) * 0.5;
                                        $minus_lower = $stairstep_income[$upline['rank'] + 1] * 0.5;
                                    } else {
                                        $amount = $totalPointsValue * $stairstep_income[$upline['rank']];
                                        $minus_lower = $stairstep_income[$upline['rank']];
                                    }

                                    $monthly_pv_maintenance = monthly_pv_maintenance($upline['upline'], $start_of_month, $end_of_month);

                                    $received = (($upline['rank'] >= 2 && $upline['rank'] <= 5 && $monthly_pv_maintenance["points"] >= 200) || ($upline['rank'] == 6 && $monthly_pv_maintenance["points"] >= 300) || ($upline['rank'] >= 7 && $upline['rank'] <= 9 && $monthly_pv_maintenance["points"] >= 500) || in_array($upline['upline'], $this->exemptedAccounts())) ? 1 : 0;

                                    $statement .= "INSERT INTO `fw_income_stairstep`(`order_id`, `upline`, `downline`, `level`, `amount`, `received`, `date_time`) VALUES (?, ?, ?, ?, ?, ?, ?);";
                                    $values = array_merge($values, array($order['id'], $upline['upline'], $purchaser['id'], $upline['level'], $amount, $received, $date_time));

                                    for ($i = $upline['rank'] + 1; $i < count($stairstep_income); $i++) {
                                        $stairstep_income[$i] = $stairstep_income[$i] - $minus_lower;
                                    }
                                }

                                if ($statement != "") {
                                    $sql = $db->prepare($statement);
                                    if (!$sql->execute($values)) { error(""); }
                                }
                            }
                        }
                    }
                }

                $sql = $db->prepare("INSERT INTO `fw_rank_points`(`account_id`, `order_id`, `points_value`, `date_time`) VALUES (?, ?, ?, ?)");
                if (!$sql->execute(array($purchaser['id'], $order['id'], $totalPointsValue, $date_time))) { error(""); }

                update_rank_points($purchaser['id'], $purchaser['id']);

                $sql = $db->prepare("SELECT `upline`, `package_id` FROM `fw_genealogy`, `fw_accounts` WHERE `downline` = ? AND `upline` = `fw_accounts`.`id`");
                if (!$sql->execute(array($purchaser['id']))) { error(""); }

                while ($sql->rowCount() == 1) {
                    $upline = $sql->fetch(PDO::FETCH_ASSOC);

                    if ($type == 1 && $upline["package_id"] == 2 && isset($packageId) && $packageId == 1) {
                        $rank_points = 25;
                    } else {
                        $rank_points = $totalPointsValue;
                    }

                    $sql = $db->prepare("INSERT INTO `fw_rank_points`(`account_id`, `order_id`, `points_value`, `date_time`) VALUES (?, ?, ?, ?);");
                    if (!$sql->execute(array($upline["upline"], $order['id'], $rank_points, $date_time))) { error(""); }

                    update_rank_points($purchaser['id'], $upline["upline"]);

                    $sql = $db->prepare("SELECT `upline`, `package_id` FROM `fw_genealogy`, `fw_accounts` WHERE `downline` = ? AND `upline` = `fw_accounts`.`id`");
                    if (!$sql->execute(array($upline["upline"]))) { error(""); }
                }
            }
        } else {
            $response["error"] = "You haven't added any item to your cart.";
        }
    }

    public function processReferralIncome(User $purchaser, Order $order, $packageId) {
        $dreamMakerIncome = array(50, 10, 10, 10, 10, 5, 5, 5);
        $dreamStarterIncome = array(150, 40, 40, 40, 40, 25, 25, 25);
        $dreamBuilderIncome = array(300, 75, 75, 75, 75, 25, 25, 25);
        $fairwinDreamIncome = array(500, 20, 20, 20, 20, 10, 10, 10);

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
            }

            if($uplinePackageId == 4) {
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

                $dspDbpFdpUpline = Downline::select('upline')
                    ->join('users', function($join) {
                        $join->on('upline', 'users.id');
                        $join->where('package_id', 1);
                        $join->orWhere('package_id', 2);
                        $join->orWhere('package_id', 3);
                    })
                    ->where('downline', $upline)
                    ->orderBy('level')
                    ->first();

                if($dspDbpFdpUpline) {
                    $referralIncomes[] = [
                        'order_id' => $order['id'],
                        'upline' => $dspDbpFdpUpline['upline'],
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
            ->get();

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
        } else { // DMP Entry
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
                $upline = $upline['id'];
            } else {
                break;
            }

            $monthlyPVMaintenance = $upline->monthlyPVMaintenance();

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
                $statement .= "INSERT INTO `fw_income_unilevel`(`order_id`, `upline`, `downline`, `level`, `amount`, `received`, `dream_maker_percentage`, `date_time`) VALUES (?, ?, ?, ?, ?, ?, ?, ?);";
                $values = array_merge($values, array($order['id'], $upline, $purchaser['id'], $i, $amount, $received, 0, $date_time));
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

                placeOrder($user['id'], array((object) ["id" => 1, "quantity" => 1]), 0, $previousOrder["full_name"], $previousOrder["contact_number"], $previousOrder["barangay"], $previousOrder["city"], $previousOrder["province"], $previousOrder["zip_code"], false);
            }
        }
    }

    public function exemptedAccounts() {
        return array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 119, 25, 22, 24, 15, 14, 88, 222);
    }

    public function checkForRankPromotion(User $user) {
        $totalRankPoints = $user->totalRankPoints();
        $directCount = $user->directCount();

        $isPromoted = false;

//        Execute upon purchase of a package
//        if($type == 1 && ($package_id == 1 || $package_id == 2 || $package_id == 3 || $package_id == 4) && $account_id == $purchaser && $current_rank == 0) {
//            $new_rank = 1;
//        }

        if ($totalRankPoints >= 10000 && $totalRankPoints < 50000 && $user['rank'] == 1 && $user["package_id"] == 1) {
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
}
