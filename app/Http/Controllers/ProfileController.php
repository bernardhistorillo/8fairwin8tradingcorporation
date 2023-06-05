<?php

namespace App\Http\Controllers;

use App\Mail\EmailVerification;
use App\Mail\ResetPasswordLink;
use App\Models\PayoutInformation;
use App\Models\User;
use App\Models\Withdrawal;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
            'referral_code' => 'required|string',
        ]);

        abort_if(!$request->payout_method, 422, 'Please add you Payout Method.');

        $usernameExists = User::where('username', $request->username)
            ->where('id', '!=', Auth::user()->id)
            ->first();

        abort_if($usernameExists, 422, 'Username already exists.');

        $referralCode = explode(config('app.url') . '/ref/', $request->referral_code);
        abort_if(count($referralCode) < 2, 422, 'Invalid Referral Code');
        abort_if(!$referralCode[1], 422, 'Invalid Referral Code');

        $referralCodeExists = User::where('referral_code', $referralCode[1])
            ->where('id', '!=', Auth::user()->id)
            ->first();

        abort_if($referralCodeExists, 422, 'Referral link already exists.');

        Auth::user()->firstname = $request->firstname;
        Auth::user()->lastname = $request->lastname;
        Auth::user()->username = $request->username;
        Auth::user()->email = $request->email_address;
        Auth::user()->contact_number = $request->contact_number;
        Auth::user()->referral_code = $referralCode[1];
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

    public function sendResetPasswordLink() {
        abort_if(!Auth::user()->email_verified_at, 422, 'Email address is not yet verified.');

        Auth::user()->reset_password_uuid = Str::uuid();
        Auth::user()->reset_password_expiration = Carbon::now()->addHours(2);
        Auth::user()->update();

        $data['firstname'] = Auth::user()->firstname;
        $data['reset_password_uuid'] = Auth::user()->reset_password_uuid;

        Mail::to('bernardhistorillo1@gmail.com')->send(new ResetPasswordLink($data));
//        Mail::to(Auth::user()->email)->send(new ResetPasswordLink($data));

        return response()->json();
    }

    public function resetPasswordPage(Request $request, $uuid) {
        $user = User::where('reset_password_uuid', $request->uuid)
            ->first();

        abort_if(!$user, 403, 'Invalid Reset Password Link');
        abort_if(Carbon::parse($user['reset_password_expiration']) < Carbon::now(), 403, 'Expired Reset Password Link');

        return view('profile.resetPassword', compact('uuid'));
    }

    public function resetPassword(Request $request) {
        $request->validate([
            'new_password' => 'required|string',
            'confirm_password' => 'required|same:new_password',
        ]);

        Auth::user()->password = Hash::make($request->new_password);
        Auth::user()->reset_password_expiration = Carbon::now();
        Auth::user()->update();

        return response()->json([
            'redirect' => route('login.index')
        ]);
    }

    public function updateProfilePicture(Request $request) {
        $request->validate([
            'image' => 'required|mimes:jpg,jpeg,png,bmp,tiff|max:10240',
            'extension' => 'required',
        ]);

        $photo = json_decode($request->photo);

        $file = file_get_contents($request->image);
        $name = Str::random(40) . '.' . $request->extension;

        $path = config('filesystems.disks.do.folder') . '/profile_pictures/' . Auth::user()->id . '/';
        Storage::disk('do')->put($path . $name, $file);

        Auth::user()->photo = config('filesystems.disks.do.cdn_endpoint') . $path . $name;
        Auth::user()->update();

        return response()->json();
    }
}
