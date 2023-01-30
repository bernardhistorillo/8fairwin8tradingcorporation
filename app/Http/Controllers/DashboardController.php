<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index() {
        $income = Auth::user()->income();
        $winnersGemValue = winnersGemValue();

        return view('dashboard.index', compact('income', 'winnersGemValue'));
    }
}
