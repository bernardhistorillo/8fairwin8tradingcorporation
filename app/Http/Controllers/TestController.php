<?php

namespace App\Http\Controllers;

use App\Mail\EmailVerification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Mail;

class TestController extends Controller
{
    public function artisan() {
        Artisan::call('view:clear');
        Artisan::call('config:cache');
        return 'Cached';
    }

    public function index(Request $request) {
        $data['firstname'] = 'Bernard';
        $data['otp'] = 182821;

//        Mail::to('bernardhistorillo1@gmail.com')->send(new EmailVerification($data));

        return view('emails.emailVerification', compact('data'));

        return base64_decode('MTI0Mw==');

        $user = User::find(18);
        return $user->terminalWinnersGem();
    }
}
