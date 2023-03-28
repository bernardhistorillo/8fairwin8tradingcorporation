<?php

namespace App\Http\Controllers;

use App\Models\Transfer;
use Illuminate\Support\Facades\Auth;

class TransferController extends Controller
{
    public function index($type = null) {
        $transfers['type'] = ($type) ?? 'received';

        if($transfers['type'] == 'received') {
            $transfers['received'] = Auth::user()->transfersReceived();
        } else if($transfers['type'] == 'sent') {
            $transfers['sent'] = Auth::user()->transfersSent();;
        }

        return view('transfers.index', compact('transfers'));
    }
}
