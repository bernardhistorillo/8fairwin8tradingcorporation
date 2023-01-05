<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function index(Request $request) {
        $totalPoolShares = HelperController::totalPoolShares();

        return view('dashboard.index', compact('totalPoolShares'));
    }
}
