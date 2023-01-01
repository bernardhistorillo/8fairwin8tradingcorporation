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
            'pin_code' => 'required|numeric|min:4|max:4',
            'confirm_pin_code' => 'required|same:pin_code',
            'sponsors_code' => 'required|exists:users,referral_code',
        ]);

        $user = User::where('email', $request->email)
            ->first();

        if($user) {
            abort(422, 'Email address is already in use.');
        }

        $upline = User::where('referral_code', $request->referral_code)
            ->first();

        $user = new User();
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->email = $request->email_address;
        $user->contact_number = $request->contact_number;
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->pin_code = $request->pin_code;
        $user->sponsor = $upline['id'];

        $referralCodeExists = true;
        while($referralCodeExists) {
            $referralCode = str_pad(rand(0, 999999), 6, STR_PAD_LEFT);
            $referralCodeExists = User::where('referral_code', $referralCode)
                ->first();
        }

        $user->referral_code = $referralCode;
        $user->save();

        Auth::login($user);

        return response()->json([]);
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

    public function logout(Request $request) {
        Auth::logout();
        return redirect()->route('auth.login');
    }

    public function loginPage(Request $request) {
        return view('login.index');
    }

    public function login(Request $request) {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if(!Auth::attempt($credentials)) {
            abort(422, 'The provided credentials do not match our records.');
        }

        return response()->json([
            'data' => [
                'is_authenticated' => Auth::check()
            ]
        ]);
    }
}
