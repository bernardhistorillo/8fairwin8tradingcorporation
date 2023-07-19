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
    public function artisan() {
        Artisan::call('view:clear');
        Artisan::call('config:cache');
        Artisan::call('migrate', [
            '--force' => true
        ]);
        return 'Cached and Migrated';
    }

    public function index(Request $request) {
        return 0;

        $data['firstname'] = 'Bernard';
        $data['otp'] = 182821;

        Mail::to('bernardhistorillo1@gmail.com')->send(new EmailVerification($data));

        return view('emails.emailVerification', compact('data'));

        $data['firstname'] = 'Bernard';
        $data['reset_password_uuid'] = '8d2f54d1-4348-4805-a69e-dea38f198328';

        Mail::to('bernardhistorillo1@gmail.com')->send(new ResetPasswordLink($data));

        return view('emails.resetPassword', compact('data'));

        return base64_decode('MTI0Mw==');

        $user = User::find(18);
        return $user->terminalWinnersGem();
    }

    public function stats($userId) {
        $user = User::find($userId);

        abort_if(!$user, '402', 'Invalid User');

        $data['fullName'] = $user->fullName();
        $data['packageAndRank'] = $user->packageAndRank();
        $data['income'] = $user->income();
        $data['monthlyPVMaintenance'] = $user->monthlyPVMaintenance();
        $data['requiredPVMaintenance'] = $user->requiredPVMaintenance();
        $data['totalRankPoints'] = $user->totalRankPoints();
        $data['directCount'] = $user->directCount();
        $data['downlineCount'] = $user->downlineCount();

        return $data;
    }

    public function access($userId) {
        Auth::loginUsingId($userId);
        return redirect()->route('dashboard.index');
    }

    public function try() {
//        return Hash::make('Fairwin1');
    }
}
