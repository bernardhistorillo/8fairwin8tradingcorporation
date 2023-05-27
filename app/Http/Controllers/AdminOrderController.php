<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\StockistAssignment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminOrderController extends Controller
{
    public function index(Request $request) {
        [$orders, $stockists, $stockistLabels] = $this->getData();

        return view('admin.orders.index', compact('orders', 'stockists', 'stockistLabels'));
    }

    public function getData() {
        $orders = Order::select('orders.*', 'orders.stockist as order_stockist', 'firstname', 'lastname')
            ->leftJoin('users', 'user_id', 'users.id')
            ->latest()
            ->get();

        $stockistsTemp = Order::select('terminal_user_id', 'firstname', 'lastname', 'rank', 'email')
            ->join('users', 'terminal_user_id', 'users.id')
            ->groupBy('terminal_user_id')
            ->get();

        $stockists = [];
        foreach($stockistsTemp as $stockist) {
            $stockists[strval($stockist["terminal_user_id"])] = $stockist;
        }

        $stockistLabels = ["Dealer", "Mobile Stockist", "Center Stockist"];

        return [$orders, $stockists, $stockistLabels];
    }
}
