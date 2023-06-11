<?php

namespace App\Http\Controllers;

use App\Mail\EmailVerification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class TestController extends Controller
{
    public function artisan() {
        Artisan::call('view:clear');
        Artisan::call('config:cache');
        Artisan::call('migrate');
        return 'Cached';
    }

    public function index(Request $request) {
        $data['firstname'] = 'Bernard';
        $data['reset_password_uuid'] = '8d2f54d1-4348-4805-a69e-dea38f198328';

//        Mail::to('bernardhistorillo1@gmail.com')->send(new EmailVerification($data));

        return view('emails.resetPassword', compact('data'));

        $data['firstname'] = 'Bernard';
        $data['otp'] = 182821;

//        Mail::to('bernardhistorillo1@gmail.com')->send(new EmailVerification($data));

        return view('emails.emailVerification', compact('data'));

        return base64_decode('MTI0Mw==');

        $user = User::find(18);
        return $user->terminalWinnersGem();
    }
}
