<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index(Request $request) {
        $user = User::find(18);
        return $user->terminalWinnersGem();
    }
}
