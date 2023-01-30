<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

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
}
