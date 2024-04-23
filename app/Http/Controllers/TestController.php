<?php

namespace App\Http\Controllers;

use App\Mail\EmailVerification;
use App\Mail\ResetPasswordLink;
use App\Models\Order;
use App\Models\StairstepIncome;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class TestController extends Controller
{
//    public function index(Request $request) {
//        $data['firstname'] = 'Bernard';
//        $data['recipient'] = 'Jose P. Bermundo';
//        $data['otp'] = 182821;
//
//        Mail::to('bernardhistorillo1@gmail.com')->queue(new EmailVerification($data));
//
//        return view('emails.winnersGemTransferVerification', compact('data'));
//
//        return 0;
//
//        $data['firstname'] = 'Bernard';
//        $data['otp'] = 182821;
//
////        Mail::to('bernardhistorillo1@gmail.com')->send(new EmailVerification($data));
//
//        return view('emails.emailVerification', compact('data'));
//
//        $data['firstname'] = 'Bernard';
//        $data['reset_password_uuid'] = '8d2f54d1-4348-4805-a69e-dea38f198328';
//
//        Mail::to('bernardhistorillo1@gmail.com')->queue(new ResetPasswordLink($data));
//
//        return view('emails.resetPassword', compact('data'));
//
//        return base64_decode('MTI0Mw==');
//
//        $user = User::find(18);
//        return $user->terminalWinnersGem();
//    }

    public function stats($userId) {
        $user = User::find($userId);

        abort_if(!$user, '402', 'Invalid User');

        $data['fullName'] = $user->fullName();
        $data['packageAndRank'] = $user->packageAndRank();
        $data['income'] = $user->income();
        $data['monthlyPVMaintenance'] = $user->monthlyPVMaintenance(Carbon::now()->startOfMonth()->toDateTimeString());
        $data['requiredPVMaintenance'] = $user->requiredPVMaintenance();
        $data['totalRankPoints'] = $user->totalRankPoints();
        $data['directCount'] = $user->directCount();
        $data['downlineCount'] = $user->downlineCount();
        $data['isDormant'] = $user->isDormant();

        return $data;
    }

//    public function access($userId) {
//        Auth::loginUsingId($userId);
//        return redirect()->route('dashboard.index');
//    }

    public function try() {
        Auth::loginUsingId(1);
        return redirect()->route('admin.dashboard.index');

        Artisan::call('fairwin:check_dormant_users');
        return 'check_dormant_users';

        if(Auth::user()->hasNoPurchaseFor180days()) {
            Auth::user()->is_dormant = 1;
            Auth::user()->update();
        }

        if(Auth::user()->is_dormant == 0) {
            return 'promote';
        } else {
            return 'no promote';
        }
    }
}
