<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TermsOfServiceController extends Controller
{
    public function index(Request $request) {
        return view('termsOfService.index');
    }
}
