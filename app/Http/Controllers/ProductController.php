<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index(Request $request) {
        $items = Item::where('status', 1)
            ->orderBy('name')
            ->get();

        $terminalUser = false;

        $showProductsTab = (!$terminalUser && (Auth::user()->package_id != 1 || Auth::user()->package_id != 3)) || ($terminalUser && ($terminalUser["package_id"] != 1 || $terminalUser["package_id"] != 3));
        $income = Auth::user()->income();

        $latestShippingInformation =  Auth::user()->latestShippingInformation();

        $type = $request->type ?? 0;

        return view('products.index', compact('items', 'showProductsTab', 'terminalUser', 'income', 'latestShippingInformation', 'type'));
    }
}
