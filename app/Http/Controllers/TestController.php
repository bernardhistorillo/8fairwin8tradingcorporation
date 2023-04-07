<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class TestController extends Controller
{
    public function artisan() {
        Artisan::call('view:clear');
        Artisan::call('config:cache');
        return 'Cached';
    }

    public function index(Request $request) {
        return base64_decode('MTI0Mw==');

        $user = User::find(18);
        return $user->terminalWinnersGem();
    }
}
