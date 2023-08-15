<?php

namespace App\Http\Controllers;

use App\Mail\TransferVerification;
use App\Models\Transfer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

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

    public function sendVerificationCode() {
        abort_if(!Auth::user()->email_verified_at, 422, 'Please verify your email address to proceed.');

        Auth::user()->email_otp = generateOTP(6);
        Auth::user()->update();

        $data['firstname'] = Auth::user()->firstname;
        $data['otp'] = Auth::user()->email_otp;
        Mail::to('bernardhistorillo1@gmail.com')->send(new TransferVerification($data));

        return response()->json();
    }

    public function submitTransfer(Request $request) {
        $request->validate([
            'username' => 'required|string',
            'amount' => 'required|integer',
            'code' => 'required|numeric',
        ]);

        $income = Auth::user()->income();

        abort_if(Auth::user()->email_otp != $request->code, 422, 'Verification code did not match.');

        abort_if($request->amount < 1, 422, 'The minimum amount that can be transferred is 1.00.');
        abort_if($income["gemBalance"] < $request->amount, 422, 'Insufficient Winners Gem Balance');

        $receiver = User::where('username', 'LIKE', $request->username)
            ->where('id', '!=', Auth::user()->id)
            ->first();

        abort_if(!$receiver, 422, 'No account found with that username.');

        Auth::user()->email_otp = null;
        Auth::user()->update();

        $transfer = new Transfer();
        $transfer->sender = Auth::user()->id;
        $transfer->receiver = $receiver['id'];
        $transfer->amount = $request->amount;
        $transfer->save();

        return response()->json([
            'gemsSent' => $income["totalGemsSent"] + $request->amount,
            'gemBalance' => $income["gemBalance"] - $request->amount,
            'redirect' => route('transfers.index', 'sent'),
        ]);
    }
}
