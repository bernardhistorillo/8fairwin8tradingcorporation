<?php

namespace App\Http\Controllers;

use App\Models\Conversion;
use App\Models\Item;
use App\Models\Order;
use App\Models\Transfer;
use App\Models\User;
use App\Models\Withdrawal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TerminalController extends Controller
{
    public function index(Request $request, $view = null) {
        if(Auth::user()->stockist == 0) {
            return redirect()->route('dashboard.index');
        }

        $terminalUser = null;
        $terminalUsers = [];
        $orders = [];
        $items = [];
        $latestShippingInformation = null;

        $terminal['type'] = ($view) ?? 'place-order';

        if(!empty($request->terminalUser)) {
            $terminalUser = User::find(base64_decode($request->terminalUser));

            if(!$terminalUser) {
                return redirect()->route('terminal.index');
            }

            $terminalUser['encodedTerminalUserId'] = $request->terminalUser;

            $items = Item::where('status', 1)
                ->orderBy('name')
                ->get();

            $latestShippingInformation = $terminalUser->latestShippingInformation();
        } else {
            if($terminal['type'] == "orders") {
                $orders = $this->ordersAsATerminalData();
            } else if($terminal['type'] == "inventory") {
                $items = Item::orderBy('name', 'asc')
                    ->get();

                foreach($items as $item) {
                    $item["terminalItemStock"] = $item->terminalItemStock(Auth::user());
                }
            } else {
                $included = (Auth::user()->stockist == 1) ? 13 : 0;

                $terminalUsers = User::where('id', '>', $included)
                    ->orderBy('firstname', 'asc')
                    ->orderBy('lastname', 'asc')
                    ->get();
            }
        }

        if(empty($request->type)) {
            $type = 2;
        } else if($request->type == 1) {
            $type = 1;
            if($terminalUser) {
                if($terminalUser["package_id"] == 3) {
                    return redirect()->route('terminal.index');
                }
            }
        } else {
            return redirect()->route('terminal.index');
        }

        $showProductsTab = (!$terminalUser && Auth::user()->package_id != 3) || ($terminalUser && $terminalUser["package_id"] != 3);

        return view('terminal.index', compact('terminal', 'terminalUsers', 'terminalUser', 'orders', 'items', 'type', 'showProductsTab', 'latestShippingInformation'));
    }

    public function ordersAsATerminalData() {
        return Auth::user()->ordersAsATerminal()
            ->select('orders.*', 'users.firstname', 'users.lastname')
            ->leftJoin('users', 'orders.user_id', 'users.id')
            ->orderBy('orders.id', 'desc')
            ->get();
    }
}
