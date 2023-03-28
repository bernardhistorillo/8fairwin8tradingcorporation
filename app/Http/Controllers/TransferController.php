<?php

namespace App\Http\Controllers;

use App\Models\Transfer;
use Illuminate\Support\Facades\Auth;

class TransferController extends Controller
{
    public function index($type = null) {
        $transfers['type'] = ($type) ?? 'received';

        if($transfers['type'] == 'products') {
            $orders['products'] = Auth::user()->orders()
                ->latest()
                ->get();
        } else if($transfers['type'] == 'winnersgem') {
            $orders['winnersGem'] = Auth::user()->gemPurchases()
                ->latest()
                ->get();
        }

        return view('transfers.index');
    }
}
