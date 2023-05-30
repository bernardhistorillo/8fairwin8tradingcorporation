<?php

namespace App\Http\Controllers;

use App\Models\Conversion;
use Illuminate\Http\Request;

class AdminConversionController extends Controller
{
    public function index(Request $request) {
        $conversions = Conversion::select('conversions.*', 'users.firstname', 'users.lastname')
            ->join('users', 'user_id', 'users.id')
            ->latest()
            ->get();

        return view('admin.conversions.index', compact('conversions'));
    }
}
