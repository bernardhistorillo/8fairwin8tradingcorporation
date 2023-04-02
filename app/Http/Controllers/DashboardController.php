<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index() {
        $income = Auth::user()->income();

        $payoutInformation = Auth::user()->payoutInformation();
        $validPayoutInformation = $payoutInformation['validPayoutInformation'];
        $payoutInformation = $payoutInformation['payoutInformation'];

        return view('dashboard.index', compact('income', 'validPayoutInformation', 'payoutInformation'));
    }
}
