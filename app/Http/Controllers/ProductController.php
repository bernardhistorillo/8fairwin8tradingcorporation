<?php

namespace App\Http\Controllers;

use App\Models\Conversion;
use App\Models\Downline;
use App\Models\GemPurchase;
use App\Models\Item;
use App\Models\Order;
use App\Models\OrderedItem;
use App\Models\RankIncentiveIncome;
use App\Models\ReferralIncome;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index() {
        $winnersGemValue = winnersGemValue();

        $items = Item::where('status', 1)
            ->orderBy('name')
            ->get();

        $terminalUser = false;
        $terminalUserDetails = false;

        $showProductsTab = (!$terminalUser && Auth::user()->package_id != 3) || ($terminalUser && $terminalUserDetails["package_id"] != 3);
        $income = Auth::user()->income();

        return view('products.index', compact('winnersGemValue', 'items', 'showProductsTab', 'terminalUser', 'terminalUserDetails', 'income'));
    }
}
