<?php

namespace App\Http\Controllers;

use App\Models\Transfer;
use App\Models\User;
use Illuminate\Http\Request;
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

    public function checkReceiver(Request $request) {
        $request->validate([
            'username' => 'required|string'
        ]);

        $receiver = User::select('firstname', 'lastname')
            ->where('username', $request->username)
            ->where('id', '!=', Auth::user()->id)
            ->first();

        $receiver = ($receiver) ? fullName($receiver) : '';

        return response()->json([
            'receiver' => $receiver
        ]);
    }

    public function submitTransfer(Request $request) {
        $request->validate([
            'username' => 'required|string',
            'amount' => 'required|integer',
            'pin_code' => 'required|numeric',
        ]);

        $income = Auth::user()->income();

        abort_if($request->amount < 1, 422, 'The minimum amount that can be transferred is 1.00.');
        abort_if($income["gemBalance"] < $request->amount, 422, 'Insufficient Winners Gem Balance');
        abort_if(Auth::user()->pin_code != $request->pin_code, 422, 'Invalid Pin Code');

        $receiver = User::where('username', $request->username)
            ->where('id', '!=', Auth::user()->id)
            ->first();

        if($receiver) {
            $sql = $db->prepare("INSERT INTO `fw_`transfer`s`(`sender`, `receiver`, `amount`, `date_time`) VALUES (?, ?, ?, ?)");
            if (!$sql->execute(array($_SESSION["fw_account_id"], $receiver['id'], $request->amount, $date_time))) { error(); }

            $response["gemsSent"] = $income["totalGemsSent"] + $request->amount;
            $response["gemBalance"] = $income["gemBalance"] - $request->amount;
        } else {
            $response["error"] = "Username didn't match any account.";
        }
    }
}
