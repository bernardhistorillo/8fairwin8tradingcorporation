<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthenticationController extends Controller
{
    public function registerPage(Request $request) {
        return view('register.index');
    }

    public function register(Request $request) {
        $request->validate([
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'contact_number' => 'required|string',
            'email_address' => 'required|email|unique:users,email',
            'username' => 'required|string|unique:users',
            'password' => 'required|string',
            'confirm_password' => 'required|same:password',
            'sponsors_code' => 'required|exists:users,referral_code',
        ]);

        $user = User::where('email', $request->email)
            ->first();

        if($user) {
            abort(422, 'Email address is already in use.');
        }

        $upline = User::where('referral_code', $request->sponsors_code)
            ->first();

        $user = new User();
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->email = $request->email_address;
        $user->contact_number = $request->contact_number;
        $user->address = $request->address;
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->sponsor = $upline['id'];

        $referralCodeExists = true;
        while($referralCodeExists) {
            $referralCode = str_pad(rand(0, 999999), 8, STR_PAD_LEFT);
            $referralCodeExists = User::where('referral_code', $referralCode)
                ->first();
        }

        $user->referral_code = $referralCode;
        $user->save();

        Auth::login($user);

        return response()->json();
    }

    public function checkSponsor(Request $request) {
        $request->validate([
            'referral_code' => 'required|string',
        ]);

        $user = User::select('firstname', 'lastname')
            ->where('referral_code', $request->referral_code)
            ->first();

        return response()->json([
            'sponsor' => ($user) ? $user->fullName() : null
        ]);
    }

    public function referral(Request $request, $referralCode) {
        $user = User::where('referral_code', $referralCode)
            ->first();

        if($user) {
            session(['referralCode' => $user['referral_code']]);
            return redirect()->route('register.index');
        }

        return redirect()->route('home.index');
    }

    public function logout(Request $request) {
        Auth::logout();
        return redirect()->route('login.index');
    }

    public function loginPage(Request $request) {
        return view('login.index');
    }

    public function login(Request $request) {
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        if(!Auth::attempt($credentials)) {
            abort(422, 'The provided credentials do not match our records.');
        }

        return response()->json();
    }
}
