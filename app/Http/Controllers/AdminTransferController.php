<?php

namespace App\Http\Controllers;

use App\Models\Transfer;
use Illuminate\Http\Request;

class AdminTransferController extends Controller
{
    public function index(Request $request) {
        $transfers = Transfer::select('transfers.*', 'senders.firstname as sender_firstname', 'senders.lastname as sender_lastname', 'receivers.firstname as receiver_firstname', 'receivers.lastname as receiver_lastname')
            ->leftJoin('users as senders', 'sender', 'senders.id')
            ->leftJoin('users as receivers', 'receiver', 'receivers.id')
            ->latest()
            ->get();

        return view('admin.transfers.index', compact('transfers'));
    }
}
