<?php

namespace App\Http\Controllers;

use App\Models\Downline;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index() {
        return view('network.index');
    }

    public function getGenealogy(Request $request) {
        $request->validate([
            'type' => 'required'
        ]);

        $topUser = User::where('id', 1)
            ->first();

        $topUser["downline"] = "1";
        $topUser["upline"] = "-1";

        $genealogy = Downline::select('downlines.*', 'users.firstname', 'users.lastname', 'users.username', 'users.referral_code', 'users.rank', 'users.package_id', 'uplines.firstname as upline_firstname', 'uplines.lastname as upline_lastname')
            ->where('level', 1)
            ->leftJoin('users', 'downline', 'users.id')
            ->leftJoin('users as uplines', 'upline', 'uplines.id')
            ->get()
            ->toArray();

        $genealogy = array_merge([$topUser], $genealogy);

        return response()->json([
            'root' => ($request->type == 1) ? "1" : Auth::user()->id,
            'genealogy' => $genealogy
        ]);
    }
}
