<?php

namespace App\Http\Controllers;

use App\Mail\EmailVerification;
use App\Models\PayoutInformation;
use App\Models\User;
use App\Models\Withdrawal;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ProfileController extends Controller
{
    public function index() {
        $payoutInformation = Auth::user()->payoutInformation()['payoutInformation'];

        return view('profile.index', compact('payoutInformation'));
    }

    public function editPersonalInfo(Request $request) {
        $request->validate([
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'email_address' => 'required|email',
            'username' => 'required|string',
            'contact_number' => 'required|numeric',
        ]);

        $usernameExists = User::where('username', $request->username)
            ->where('id', '!=', Auth::user()->id)
            ->first();

        abort_if($usernameExists, 422, 'Username already exists.');

        Auth::user()->firstname = $request->firstname;
        Auth::user()->lastname = $request->lastname;
        Auth::user()->username = $request->username;
        Auth::user()->email = $request->email_address;
        Auth::user()->contact_number = $request->contact_number;
        Auth::user()->update();

        $payoutInformation = Auth::user()->payoutInformation()['payoutInformation'];

        if($payoutInformation['method'] == '') {
            $payoutInformation = new PayoutInformation();
            $payoutInformation->user_id = Auth::user()->id;
            $payoutInformation->method = $request->payout_method;
            $payoutInformation->account_number = $request->payout_account_number;
            $payoutInformation->account_name = $request->payout_account_name;
            $payoutInformation->name = $request->payout_name;
            $payoutInformation->mobile_number = $request->payout_mobile_number;
            $payoutInformation->wallet_address = $request->payout_wallet_address;
            $payoutInformation->save();
        } else {
            $payoutInformation->method = $request->payout_method;
            $payoutInformation->account_number = $request->payout_account_number;
            $payoutInformation->account_name = $request->payout_account_name;
            $payoutInformation->name = $request->payout_name;
            $payoutInformation->mobile_number = $request->payout_mobile_number;
            $payoutInformation->wallet_address = $request->payout_wallet_address;
            $payoutInformation->update();
        }

        return response()->json();
    }

    public function sendEmailOTP() {
        abort_if(Auth::user()->email_verified_at, 422, 'Email address is already verified.');

        Auth::user()->email_otp = generateOTP(6);
        Auth::user()->update();

        $data['firstname'] = Auth::user()->firstname;
        $data['otp'] = Auth::user()->email_otp;

        Mail::to(Auth::user()->email)->send(new EmailVerification($data));

        return response()->json();
    }

    public function verifyEmail(Request $request) {
        $request->validate([
            'otp' => 'required|numeric'
        ]);

        abort_if(Auth::user()->email_otp != $request->otp, 422, 'Invalid One-Time Pin');

        Auth::user()->email_otp = null;
        Auth::user()->email_verified_at = Carbon::now();
        Auth::user()->update();

        return response()->json();
    }
}
