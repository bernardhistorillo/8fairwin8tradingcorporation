<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index() {
        $items = Item::where('status', 1)
            ->orderBy('name')
            ->get();

        $terminalUser = false;
        $terminalUserDetails = false;

        $showProductsTab = (!$terminalUser && Auth::user()->package_id != 3) || ($terminalUser && $terminalUserDetails["package_id"] != 3);
        $income = Auth::user()->income();

        return view('products.index', compact('items', 'showProductsTab', 'terminalUser', 'terminalUserDetails', 'income'));
    }
}
