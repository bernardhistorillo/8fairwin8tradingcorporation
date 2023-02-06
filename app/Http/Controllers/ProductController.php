<?php

namespace App\Http\Controllers;

use App\Models\Conversion;
use App\Models\Downline;
use App\Models\GemPurchase;
use App\Models\Item;
use App\Models\Order;
use App\Models\RankIncentiveIncome;
use App\Models\User;
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

    # ask sir jo kung fdp na instead of dbp
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

    public function checkForRankPromotion(User $user) {
        $totalRankPoints = $user->totalRankPoints();
        $directCount = $user->directCount();

        $isPromoted = false;

//        Execute upon purchase of a package
//        if($type == 1 && ($package_id == 1 || $package_id == 2 || $package_id == 3 || $package_id == 4) && $account_id == $current_account_id && $current_rank == 0) {
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

    public function placeOrder(Request $request) {
        $request->validate([
            'items' => 'required',
            'stockist' => 'required|numeric',
            'terminal_account' => 'required',
        ]);

        $items = $request->items;
        if(count($request->items) == 0) {
            abort(422, "You haven't added any items to your cart.");
        }

        if(count($items) > 0) {
            $terminalAccount = null;

            if($request->terminal_account == 0) {
                $purchaser = Auth::user();

                if(!(($purchaser["stockist"] == 2 && $request->stockist == 2) || ($purchaser["stockist"] == 2 && $request->stockist == 0) || ($purchaser["stockist"] == 1 && $request->stockist == 1) || ($purchaser["stockist"] == 1 && $request->stockist == 0) || $purchaser["stockist"] == 0)) {
                    abort(422, "Your account has no privilege for this purchase.");
                }
            } else {
                if(Auth::user()->stockist > 0) {
                    $terminal_account_id = base64_decode($_POST["terminal_account"]);

                    $terminalAccount = User::find($terminal_account_id);
                    if($terminalAccount) {
                        $purchaser = $terminalAccount;
                    } else {
                        abort(422, "Invalid Purchaser");
                    }
                } else {
                    abort(422, "You have no privilege to access the terminal.");
                }
            }

            if($request->stockist == 1) {


                $sql = $db->prepare("SELECT `stockist` FROM `fw_stockist_assignment` WHERE `assigned` = ?");
                if(!$sql->execute(array($current_account_id))) { error(""); }
                $terminal_account_id = $sql->fetch(PDO::FETCH_ASSOC);
                $terminal_account_id = $terminal_account_id["stockist"];
            } else if($request->stockist == 2) {
                $terminalAccount = null;
            }

            if($terminalAccount) {
                // get what type of stockist the terminal account is
                $sql = $db->prepare("SELECT `stockist` FROM `fw_accounts` WHERE `id` = ?");
                if (!$sql->execute(array($terminal_account_id))) { error(""); }
                $terminal_stockist = $sql->fetch(PDO::FETCH_ASSOC);
                $terminal_stockist = $terminal_stockist["stockist"];
            }

            if(!$mass_place_order) {
                $total_price = 0;
                $total_points_value = 0;
                $less_in_stock = 0;

                $winnersGemValue = winnersGemValue();

                for($i = 0; $i < count($items); $i++) {
                    if($request->stockist == 0) {
                        $sql = $db->prepare("SELECT `rank` FROM `fw_accounts` WHERE `id` = ?");
                        if (!$sql->execute(array($current_account_id))) { error(""); }
                        $rank = $sql->fetch(PDO::FETCH_ASSOC);

                        if($rank["rank"] > 0) {
                            $price = "distributors_price";
                        } else {
                            $price = "suggested_retail_price";
                        }
                    } else if($request->stockist == 1) {
                        $price = "mobile_price";
                    } else if($request->stockist == 2) {
                        $price = "center_price";
                    }

                    $sql = $db->prepare("SELECT `type`, `" . $price . "`, `points_value` FROM `fw_items` WHERE `id` = ?");
                    if (!$sql->execute(array($items[$i]->id))) { error(""); }
                    $item_details = $sql->fetch(PDO::FETCH_ASSOC);

                    $type = $item_details["type"];

                    $items[$i]->price = $item_details[$price] / $winnersGemValue;
                    $items[$i]->points_value = $item_details["points_value"];

                    $total_price += $items[$i]->quantity * $items[$i]->price;
                    $total_points_value += $items[$i]->quantity * $items[$i]->points_value;

                    if($terminalAccount && $request->stockist != 2) { // if purchased by a stockist but not a center stockist, stock is checked
                        $item_stock = terminal_item_stock($items[$i]->id, $terminal_account_id, $terminal_stockist);

                        if($item_stock["in_stock"] < $items[$i]->quantity) {
                            $less_in_stock++;
                        }
                    }
                }

                if($terminalAccount && $request->stockist != 2) { // if purchased by a stockist but not a center stockist, stock is checked
                    if($less_in_stock > 0) {
                        error($less_in_stock . " of the items to be ordered " . (($less_in_stock > 1) ? "are" : "is") . " less in stock.");
                    }
                }
            } else {
                $total_price = $order["price"];
                $total_points_value = $order["points_value"];
                $type = $order["type"];
            }

            if($request->stockist) {
                $type = 2;
            }

            if(!$mass_place_order) {
                if($terminalAccount) {
                    $terminal_winners_gem = terminal_winners_gem($_SESSION["fw_account_id"]);

                    if(number_format($terminal_winners_gem["balance"],"2",".","") < number_format($total_points_value,"2",".","")) {
                        error("Insufficient Winners Gem");
                    }
                } else {
                    $earnings = earnings($current_account_id);

                    if(number_format($earnings["gem_balance"],"2",".","") < number_format($total_price,"2",".","")) {
                        error("Insufficient Winners Gem");
                    }
                }
            }

            if(!$mass_place_order) {
                $code_exists = 1;
                while ($code_exists == 1) {
                    $characters = "ABCDEFGHJKLMNPQRSTUVWXYZ23456789";
                    $characters_length = strlen($characters);
                    $generated_code = "";
                    for ($j = 0; $j < 8; $j++) {
                        $generated_code = $generated_code . $characters[rand(0, $characters_length - 1)];
                    }
                    $sql = $db->prepare("SELECT `id` FROM `fw_orders` WHERE `reference` = ?");
                    if (!$sql->execute(array($generated_code))) { error(""); }
                    $code_exists = $sql->rowCount();
                }

                if($request->stockist == 0) {
                    $pool_share = ($type == 1) ? $total_points_value : $total_points_value * 0.1;
                } else {
                    $pool_share = 0;
                }

                $sql = $db->prepare("INSERT INTO `fw_orders`(`type`, `stockist`, `reference`, `account_id`, `price`, `points_value`, `pool_share`, `full_name`, `contact_number`, `barangay`, `city`, `province`, `zip_code`, `terminal_account_id`, `date_time_placed`, `date_time_completed`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                if(!$sql->execute(array($type, $request->stockist, $generated_code, $current_account_id, $total_price, $total_points_value, $pool_share, $full_name, $contact_number, $barangay, $city, $province, $zip_code, $terminal_account_id, $date_time, "0000-00-00 00:00:00"))) { error(""); }
                $order_id = $db->lastInsertId();

                for($i = 0; $i < count($items); $i++) {
                    $sql = $db->prepare("INSERT INTO `fw_ordered_items`(`order_id`, `item_id`, `quantity`, `price`, `points_value`) VALUES (?, ?, ?, ?, ?)");
                    if (!$sql->execute(array($order_id, $items[$i]->id, $items[$i]->quantity, $items[$i]->price, $items[$i]->points_value))) { error(""); }
                }
            } else {
                $order_id = $order["id"];
            }

            if($request->stockist == 0) {
                if($type == 1 && $current_account_id > 1) { // Package Purchase
                    $sql = $db->prepare("SELECT `item_id` FROM `fw_ordered_items` WHERE `order_id` = ?");
                    if (!$sql->execute(array($order_id))) { error(""); }
                    $item_id = $sql->fetch(PDO::FETCH_ASSOC);
                    $item_id = $item_id["item_id"];

                    $sql = $db->prepare("SELECT `package_id`, `sponsor`, `rank` FROM `fw_accounts` WHERE `id` = ?");
                    if (!$sql->execute(array($current_account_id))) { error(""); }
                    $account = $sql->fetch(PDO::FETCH_ASSOC);
                    $package_id = $account["package_id"];

                    $purchased_package = ($item_id == 1) ? 1 : (($item_id == 21) ? 3 : (($item_id == 28) ? 4 : 2));

                    $is_from_free_account_upgrade = ($package_id == 0 && ($purchased_package == 4 || $purchased_package == 2 || $purchased_package == 1 || $purchased_package == 3));
                    $is_from_dream_maker_upgrade = ($package_id == 4 && ($purchased_package == 2 || $purchased_package == 1 || $purchased_package == 3));
                    $is_from_dream_starter_upgrade = ($package_id == 2 && ($purchased_package == 1 || $purchased_package == 3));
                    $is_from_fairwin_dream_upgrade = ($package_id == 3 && ($purchased_package == 3));

                    if ($is_from_free_account_upgrade || $is_from_dream_maker_upgrade || $is_from_dream_starter_upgrade ||
                        $is_from_Fairwin_dream__upgrade ||
                        $is_from_dream_builder_upgrade) {
                        $package_id = $purchased_package;

                        $sql = $db->prepare("UPDATE `fw_accounts` SET `package_id` = ? WHERE `id` = ?");
                        if (!$sql->execute(array($purchased_package, $current_account_id))) { error(""); }
                    }

                    $sql = $db->prepare("SELECT `id` FROM `fw_genealogy` WHERE `upline` = ? AND `downline` = ?");
                    if (!$sql->execute(array($account["sponsor"], $current_account_id))) { error(""); }
                    if ($sql->rowCount() == 0) {
                        $sql = $db->prepare("INSERT INTO `fw_genealogy`(`upline`, `downline`) VALUES (?, ?)");
                        if (!$sql->execute(array($account["sponsor"], $current_account_id))) { error(""); }

                        // Downline Ranks
                        $upline = $account["sponsor"];
                        $upline_rank = $account["rank"];
                        $downline = $current_account_id;
                        $level = 1;

                        $sql = $db->prepare("SELECT `downline` FROM `fw_genealogy` WHERE `upline` = ?");
                        if (!$sql->execute(array($upline))) { error(""); }
                        $directs = $sql->fetchAll(PDO::FETCH_ASSOC);

                        foreach ($directs as $i => $direct) {
                            if ($direct["downline"] == $downline) {
                                break;
                            }
                        }

                        $sql = $db->prepare("INSERT INTO `fw_downlines`(`upline`, `downline`, `leg`, `level`) VALUES (?, ?, ?, ?)");
                        if (!$sql->execute(array($upline, $current_account_id, $i + 1, $level++))) { error(""); }

                        $downline = $upline;

                        $sql = $db->prepare("SELECT `upline`, `rank` FROM `fw_genealogy`, `fw_accounts` WHERE `downline` = ? AND `upline` = `fw_accounts`.`id`");
                        if (!$sql->execute(array($downline))) { error(""); }

                        while ($sql->rowCount() == 1) {
                            $upline = $sql->fetch(PDO::FETCH_ASSOC);

                            $sql = $db->prepare("SELECT `downline` FROM `fw_genealogy` WHERE `upline` = ?");
                            if (!$sql->execute(array($upline["upline"]))) { error(""); }
                            $directs = $sql->fetchAll(PDO::FETCH_ASSOC);

                            foreach ($directs as $i => $direct) {
                                if ($direct["downline"] == $downline) {
                                    break;
                                }
                            }

                            $sql = $db->prepare("INSERT INTO `fw_downlines`(`upline`, `downline`, `leg`, `level`) VALUES (?, ?, ?, ?)");
                            if (!$sql->execute(array($upline["upline"], $current_account_id, $i + 1, $level++))) { error(""); }

                            $downline = $upline["upline"];

                            $sql = $db->prepare("SELECT `upline` FROM `fw_genealogy` WHERE `downline` = ?");
                            if (!$sql->execute(array($downline))) { error(""); }
                        }
                    }

                    // referral income
                    $dream_maker_income = array(50, 10, 10, 10, 10, 5, 5, 5);
                    $quick_start_income = array(150, 40, 40, 40, 40, 25, 25, 25);
                    $dream_builder_income = array(300, 75, 75, 75, 75, 25, 25, 25);
                    $fairwin_dream_income = array(500, 20, 20, 20, 20, 10, 10, 10);

                    $downline = $current_account_id;

                    $statement = '';
                    $values = array();

                    $referral_uplines = array();
                    for ($i = 1; $i <= count($dream_builder_income); $i++) {
                        $sql = $db->prepare("SELECT `upline`, `package_id`, `rank` FROM `fw_genealogy`, `fw_accounts` WHERE `downline` = ? AND `upline` = `fw_accounts`.`id`");
                        if (!$sql->execute(array($downline))) { error(""); }
                        if ($sql->rowCount() == 1) {
                            $upline = $sql->fetch(PDO::FETCH_ASSOC);
                            array_push($referral_uplines, $upline);
                            $upline_package_id = $upline['package_id'];
                            $upline = $upline['upline'];
                        } else {
                            break;
                        }

                        if($package_id == 4) {
                            $amount = $dream_maker_income[$i - 1];
                        } else if($package_id == 2) {
                            $amount = $quick_start_income[$i - 1];
                        } else if($package_id == 1) {
                            $amount = $dream_builder_income[$i - 1];
                        } else if($package_id == 3) {
                            $amount = $fairwin_dream_income[$i - 1];
                        }

                        if($upline_package_id == 4) {
                            $statement .= "INSERT INTO `fw_income_referral`(`order_id`, `upline`, `downline`, `level`, `amount`, `dream_maker_percentage`, `date_time`) VALUES (?, ?, ?, ?, ?, ?, ?);";
                            $values = array_merge($values, array($order_id, $upline, $current_account_id, $i, $amount * 0.7, 0.7, $date_time));

                            $sql = $db->prepare("SELECT `upline` FROM `fw_downlines`, `fw_accounts` WHERE `downline` = ? AND `upline` = `fw_accounts`.`id` AND (`package_id` = 1 OR `package_id` = 2 OR `package_id` = 3) ORDER BY `level` ASC LIMIT 1");
                            if (!$sql->execute(array($upline))) { error(""); }
                            $dsp_dbp_fdp_upline = $sql->fetch(PDO::FETCH_ASSOC);

                            if($dsp_dbp_fdp_upline) {
                                $statement .= "INSERT INTO `fw_income_referral`(`order_id`, `upline`, `downline`, `level`, `amount`, `dream_maker_percentage`, `date_time`) VALUES (?, ?, ?, ?, ?, ?, ?);";
                                $values = array_merge($values, array($order_id, $dsp_dbp_fdp_upline['upline'], $current_account_id, $i, $amount * 0.3, 0.3, $date_time));
                            }
                        } else {
                            $statement .= "INSERT INTO `fw_income_referral`(`order_id`, `upline`, `downline`, `level`, `amount`, `dream_maker_percentage`, `date_time`) VALUES (?, ?, ?, ?, ?, ?, ?);";
                            $values = array_merge($values, array($order_id, $upline, $current_account_id, $i, $amount, 0, $date_time));
                        }

                        $downline = $upline;
                    }

                    if ($statement != "") {
                        $sql = $db->prepare($statement);
                        if (!$sql->execute($values)) { error(""); }
                    }

                    foreach($referral_uplines as $referral_upline) {
                        automatic_fdp_upgrade($referral_upline["upline"], $referral_upline["rank"], $referral_upline["package_id"]);
                    }

                    // infinity plus bonus
                    $sql = $db->prepare("SELECT `upline`, `rank`, `level` FROM ( (SELECT `upline`, `rank`, `level` FROM `fw_downlines`, `fw_accounts` WHERE `downline` = ? AND `upline` = `fw_accounts`.`id` AND `rank` = 2 ORDER BY `level` ASC LIMIT 2) UNION ALL (SELECT `upline`, `rank`, `level` FROM `fw_downlines`, `fw_accounts` WHERE `downline` = ? AND `upline` = `fw_accounts`.`id` AND `rank` = 3 ORDER BY `level` ASC LIMIT 2) UNION ALL (SELECT `upline`, `rank`, `level` FROM `fw_downlines`, `fw_accounts` WHERE `downline` = ? AND `upline` = `fw_accounts`.`id` AND `rank` = 4 ORDER BY `level` ASC LIMIT 2) UNION ALL (SELECT `upline`, `rank`, `level` FROM `fw_downlines`, `fw_accounts` WHERE `downline` = ? AND `upline` = `fw_accounts`.`id` AND `rank` = 5 ORDER BY `level` ASC LIMIT 2) UNION ALL (SELECT `upline`, `rank`, `level` FROM `fw_downlines`, `fw_accounts` WHERE `downline` = ? AND `upline` = `fw_accounts`.`id` AND `rank` = 6 ORDER BY `level` ASC LIMIT 2) UNION ALL (SELECT `upline`, `rank`, `level` FROM `fw_downlines`, `fw_accounts` WHERE `downline` = ? AND `upline` = `fw_accounts`.`id` AND `rank` = 7 ORDER BY `level` ASC LIMIT 2) UNION ALL (SELECT `upline`, `rank`, `level` FROM `fw_downlines`, `fw_accounts` WHERE `downline` = ? AND `upline` = `fw_accounts`.`id` AND `rank` = 8 ORDER BY `level` ASC LIMIT 2) UNION ALL (SELECT `upline`, `rank`, `level` FROM `fw_downlines`, `fw_accounts` WHERE `downline` = ? AND `upline` = `fw_accounts`.`id` AND `rank` = 9 ORDER BY `level` ASC LIMIT 1) ) AS `table` WHERE `rank` >= 2 ORDER BY `level` ASC");
                    if (!$sql->execute(array($current_account_id, $current_account_id, $current_account_id, $current_account_id, $current_account_id, $current_account_id, $current_account_id, $current_account_id))) { error(""); }
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

                    if($package_id == 1) { // DBP Entry
                        $infinity_plus_income = array(0, 0, 100, 200, 300, 400, 500, 600, 700, 800);
                    } else if($package_id == 3) { // FDP Entry
                        $infinity_plus_income = array(0, 0, 60, 120, 180, 240, 300, 330, 360, 390);
                    } else if($package_id == 2) { // QSP Entry
                        $infinity_plus_income = array(0, 0, 40, 80, 120, 160, 200, 240, 280, 320);
                    } else { // DMP Entry
                        $infinity_plus_income = array(0, 0, 10, 20, 30, 40, 50, 60, 70, 80);
                    }

                    $statement = '';
                    $values = array();

                    foreach ($uplines as $key => $upline) {
                        if($key >= 1 && $upline['rank'] == $uplines[$key - 1]["rank"] && $upline['rank'] <= 9) {
                            $amount = $infinity_plus_income[$upline['rank'] + 1] * 0.5;
                            $minus_lower = $infinity_plus_income[$upline['rank'] + 1] * 0.5;
                        } else {
                            $amount = $infinity_plus_income[$upline['rank']];
                            $minus_lower = $infinity_plus_income[$upline['rank']];
                        }

                        $statement .= "INSERT INTO `fw_income_infinity_plus`(`order_id`, `upline`, `downline`, `level`, `amount`, `date_time`) VALUES (?, ?, ?, ?, ?, ?);";
                        $values = array_merge($values, array($order_id, $upline['upline'], $current_account_id, $upline['level'], $amount, $date_time));

                        for ($i = $upline['rank'] + 1; $i < count($infinity_plus_income); $i++) {
                            $infinity_plus_income[$i] = $infinity_plus_income[$i] - $minus_lower;
                        }
                    }

                    if ($statement != "") {
                        $sql = $db->prepare($statement);
                        if (!$sql->execute($values)) { error(""); }
                    }
                } else if($type == 2) { // Product Purchase
                    $sql = $db->prepare("SELECT `rank`, `package_id` FROM `fw_accounts` WHERE `id` = ?");
                    if (!$sql->execute(array($current_account_id))) { error(""); }
                    $account = $sql->fetch(PDO::FETCH_ASSOC);

                    // personal rebate
                    if($account["rank"] >= 1) {
                        $personal_rebate_percentages = array(0, 0.1, 0.2, 0.3, 0.4, 0.5, 0.6, 0.6, 0.6, 0.6);

                        if($account['package_id'] == 4) {
                            $sql = $db->prepare("INSERT INTO `fw_income_personal_rebate`(`order_id`, `account_id`, `amount`, `dream_maker_percentage`, `date_time`) VALUES (?, ?, ?, ?, ?)");
                            if(!$sql->execute(array($order_id, $current_account_id, $total_points_value * $personal_rebate_percentages[$account["rank"]] * 0.7, 0.7, $date_time))) { error(""); }

                            $sql = $db->prepare("SELECT `upline` FROM `fw_downlines`, `fw_accounts` WHERE `downline` = ? AND `upline` = `fw_accounts`.`id` AND (`package_id` = 1 OR `package_id` = 2 OR `package_id` = 3) ORDER BY `level` ASC LIMIT 1");
                            if (!$sql->execute(array($current_account_id))) { error(""); }
                            $dsp_dbp_fdp_upline = $sql->fetch(PDO::FETCH_ASSOC);

                            if($dsp_dbp_fdp_upline) {
                                $sql = $db->prepare("INSERT INTO `fw_income_personal_rebate`(`order_id`, `account_id`, `amount`, `dream_maker_percentage`, `date_time`) VALUES (?, ?, ?, ?, ?)");
                                if(!$sql->execute(array($order_id, $dsp_dbp_fdp_upline['upline'], $total_points_value * $personal_rebate_percentages[$account["rank"]] * 0.3, 0.3, $date_time))) { error(""); }
                            }
                        } else {
                            $sql = $db->prepare("INSERT INTO `fw_income_personal_rebate`(`order_id`, `account_id`, `amount`, `dream_maker_percentage`, `date_time`) VALUES (?, ?, ?, ?, ?)");
                            if(!$sql->execute(array($order_id, $current_account_id, $total_points_value * $personal_rebate_percentages[$account["rank"]], 0, $date_time))) { error(""); }
                        }

                        automatic_fdp_upgrade($current_account_id, $account["rank"], $account["package_id"]);
                    }

                    if($current_account_id > 1) {
                        // check updated monthly maintenance of buyer
                        $monthly_pv_maintenance = monthly_pv_maintenance($current_account_id, $start_of_month, $end_of_month);

                        if ($monthly_pv_maintenance["points"] >= 100) {
                            $sql = $db->prepare("UPDATE `fw_income_unilevel` SET `received` = 1 WHERE `upline` = ? AND `date_time` >= ? AND `date_time` <= ?");
                            if (!$sql->execute(array($current_account_id, $start_of_month, $end_of_month))) { error(""); }

                            if(($account['rank'] >= 2 && $account['rank'] <= 5 && $monthly_pv_maintenance["points"] >= 200) || ($account['rank'] == 6 && $monthly_pv_maintenance["points"] >= 300) || ($account['rank'] >= 7 && $account['rank'] <= 9 && $monthly_pv_maintenance["points"] >= 500)) {
                                $sql = $db->prepare("UPDATE `fw_income_stairstep` SET `received` = 1 WHERE `upline` = ? AND `date_time` >= ? AND `date_time` <= ?");
                                if (!$sql->execute(array($current_account_id, $start_of_month, $end_of_month))) { error(""); }
                            }

                            automatic_fdp_upgrade($current_account_id, $account["rank"], $account["package_id"]);
                        }

                        // unilevel
                        $unilevel_income = array(0.05, 0.05, 0.05, 0.05, 0.05, 0.03, 0.03, 0.03);

                        $downline = $current_account_id;

                        $statement = '';
                        $values = array();

                        $referral_uplines = array();
                        for ($i = 1; $i <= count($unilevel_income); $i++) {
                            $sql = $db->prepare("SELECT `upline`, `package_id`, `rank` FROM `fw_genealogy`, `fw_accounts` WHERE `downline` = ? AND `upline` = `fw_accounts`.`id`");
                            if (!$sql->execute(array($downline))) { error(""); }
                            if ($sql->rowCount() == 1) {
                                $upline = $sql->fetch(PDO::FETCH_ASSOC);
                                array_push($referral_uplines, $upline);
                                $upline_package_id = $upline['package_id'];
                                $upline = $upline['upline'];
                            } else {
                                break;
                            }

                            $monthly_pv_maintenance = monthly_pv_maintenance($upline, $start_of_month, $end_of_month);

                            if($upline_package_id == 4) {
                                $received = ($monthly_pv_maintenance["points"] >= 50 || in_array($upline, $excepted_accounts)) ? 1 : 0;
                            } else {
                                $received = ($monthly_pv_maintenance["points"] >= 100 || in_array($upline, $excepted_accounts)) ? 1 : 0;
                            }

                            $amount = $total_points_value * $unilevel_income[$i - 1];

                            if($upline_package_id == 4) {
                                $statement .= "INSERT INTO `fw_income_unilevel`(`order_id`, `upline`, `downline`, `level`, `amount`, `received`, `dream_maker_percentage`, `date_time`) VALUES (?, ?, ?, ?, ?, ?, ?, ?);";
                                $values = array_merge($values, array($order_id, $upline, $current_account_id, $i, $amount * 0.7, $received, 0.7, $date_time));

                                $sql = $db->prepare("SELECT `upline` FROM `fw_downlines`, `fw_accounts` WHERE `downline` = ? AND `upline` = `fw_accounts`.`id` AND (`package_id` = 1 OR `package_id` = 2 OR `package_id` = 3) ORDER BY `level` ASC LIMIT 1");
                                if (!$sql->execute(array($upline))) { error(""); }
                                $dsp_dbp_dcp_upline = $sql->fetch(PDO::FETCH_ASSOC);

                                if($dsp_dbp_fdp_upline) {
                                    $statement .= "INSERT INTO `fw_income_unilevel`(`order_id`, `upline`, `downline`, `level`, `amount`, `received`, `dream_maker_percentage`, `date_time`) VALUES (?, ?, ?, ?, ?, ?, ?, ?);";
                                    $values = array_merge($values, array($order_id, $dsp_dbp_fdp_upline['upline'], $current_account_id, $i, $amount * 0.3, $received, 0.3, $date_time));
                                }
                            } else {
                                $statement .= "INSERT INTO `fw_income_unilevel`(`order_id`, `upline`, `downline`, `level`, `amount`, `received`, `dream_maker_percentage`, `date_time`) VALUES (?, ?, ?, ?, ?, ?, ?, ?);";
                                $values = array_merge($values, array($order_id, $upline, $current_account_id, $i, $amount, $received, 0, $date_time));
                            }

                            $downline = $upline;
                        }

                        if ($statement != "") {
                            $sql = $db->prepare($statement);
                            if (!$sql->execute($values)) { error(""); }
                        }

                        foreach($referral_uplines as $referral_upline) {
                            automatic_fdp_upgrade($referral_upline["upline"], $referral_upline["rank"], $referral_upline["package_id"]);
                        }

                        // stairstep
                        if($account["rank"] <= 6) {
                            $sql = $db->prepare("SELECT `upline`, `rank`, `level` FROM ( (SELECT `upline`, `rank`, `level` FROM `fw_downlines`, `fw_accounts` WHERE `downline` = ? AND `upline` = `fw_accounts`.`id` AND `rank` = 2 ORDER BY `level` ASC LIMIT 2) UNION ALL (SELECT `upline`, `rank`, `level` FROM `fw_downlines`, `fw_accounts` WHERE `downline` = ? AND `upline` = `fw_accounts`.`id` AND `rank` = 3 ORDER BY `level` ASC LIMIT 2) UNION ALL (SELECT `upline`, `rank`, `level` FROM `fw_downlines`, `fw_accounts` WHERE `downline` = ? AND `upline` = `fw_accounts`.`id` AND `rank` = 4 ORDER BY `level` ASC LIMIT 2) UNION ALL (SELECT `upline`, `rank`, `level` FROM `fw_downlines`, `fw_accounts` WHERE `downline` = ? AND `upline` = `fw_accounts`.`id` AND `rank` = 5 ORDER BY `level` ASC LIMIT 2) UNION ALL (SELECT `upline`, `rank`, `level` FROM `fw_downlines`, `fw_accounts` WHERE `downline` = ? AND `upline` = `fw_accounts`.`id` AND `rank` = 6 ORDER BY `level` ASC LIMIT 1) UNION ALL (SELECT `upline`, `rank`, `level` FROM `fw_downlines`, `fw_accounts` WHERE `downline` = ? AND `upline` = `fw_accounts`.`id` AND `rank` = 7 ORDER BY `level` ASC LIMIT 1) UNION ALL (SELECT `upline`, `rank`, `level` FROM `fw_downlines`, `fw_accounts` WHERE `downline` = ? AND `upline` = `fw_accounts`.`id` AND `rank` = 8 ORDER BY `level` ASC LIMIT 1) UNION ALL (SELECT `upline`, `rank`, `level` FROM `fw_downlines`, `fw_accounts` WHERE `downline` = ? AND `upline` = `fw_accounts`.`id` AND `rank` = 9 ORDER BY `level` ASC LIMIT 1) ) AS `table` WHERE `rank` >= ? ORDER BY `level` ASC");
                            if (!$sql->execute(array($current_account_id, $current_account_id, $current_account_id, $current_account_id, $current_account_id, $current_account_id, $current_account_id, $current_account_id, $account["rank"]))) { error(""); }
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

                            if(count($uplines) >= 2 && $account["rank"] == $uplines[0]["rank"] && $uplines[0]["rank"] == $uplines[1]["rank"]) {
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
                                $minus_lower = $stairstep_income[$account["rank"]];
                                for ($i = 0; $i < count($stairstep_income); $i++) {
                                    $stairstep_income[$i] -= $minus_lower;
                                }

                                $statement = '';
                                $values = array();

                                foreach ($uplines as $key => $upline) {
                                    if (($upline["rank"] == $account["rank"] || ($key >= 1 && $upline['rank'] == $uplines[$key - 1]["rank"])) && $upline['rank'] < 6) {
                                        $amount = ($total_points_value * $stairstep_income[$upline['rank'] + 1]) * 0.5;
                                        $minus_lower = $stairstep_income[$upline['rank'] + 1] * 0.5;
                                    } else {
                                        $amount = $total_points_value * $stairstep_income[$upline['rank']];
                                        $minus_lower = $stairstep_income[$upline['rank']];
                                    }

                                    $monthly_pv_maintenance = monthly_pv_maintenance($upline['upline'], $start_of_month, $end_of_month);

                                    $received = (($upline['rank'] >= 2 && $upline['rank'] <= 5 && $monthly_pv_maintenance["points"] >= 200) || ($upline['rank'] == 6 && $monthly_pv_maintenance["points"] >= 300) || ($upline['rank'] >= 7 && $upline['rank'] <= 9 && $monthly_pv_maintenance["points"] >= 500) || in_array($upline['upline'], $excepted_accounts)) ? 1 : 0;

                                    $statement .= "INSERT INTO `fw_income_stairstep`(`order_id`, `upline`, `downline`, `level`, `amount`, `received`, `date_time`) VALUES (?, ?, ?, ?, ?, ?, ?);";
                                    $values = array_merge($values, array($order_id, $upline['upline'], $current_account_id, $upline['level'], $amount, $received, $date_time));

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
                if (!$sql->execute(array($current_account_id, $order_id, $total_points_value, $date_time))) { error(""); }

                update_rank_points($current_account_id, $current_account_id);

                $sql = $db->prepare("SELECT `upline`, `package_id` FROM `fw_genealogy`, `fw_accounts` WHERE `downline` = ? AND `upline` = `fw_accounts`.`id`");
                if (!$sql->execute(array($current_account_id))) { error(""); }

                while ($sql->rowCount() == 1) {
                    $upline = $sql->fetch(PDO::FETCH_ASSOC);

                    if ($type == 1 && $upline["package_id"] == 2 && $package_id == 1) {
                        $rank_points = 25;
                    } else {
                        $rank_points = $total_points_value;
                    }

                    $sql = $db->prepare("INSERT INTO `fw_rank_points`(`account_id`, `order_id`, `points_value`, `date_time`) VALUES (?, ?, ?, ?);");
                    if (!$sql->execute(array($upline["upline"], $order_id, $rank_points, $date_time))) { error(""); }

                    update_rank_points($current_account_id, $upline["upline"]);

                    $sql = $db->prepare("SELECT `upline`, `package_id` FROM `fw_genealogy`, `fw_accounts` WHERE `downline` = ? AND `upline` = `fw_accounts`.`id`");
                    if (!$sql->execute(array($upline["upline"]))) { error(""); }
                }
            }
        } else {
            $response["error"] = "You haven't added any item to your cart.";
        }
    }
}
