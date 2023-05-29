<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Order;
use App\Models\StockistAssignment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminItemController extends Controller
{
    public function index(Request $request) {
        $itemId = $request->item;

        $items = [];
        $item = null;

        if(!$itemId) {
            $items = Item::all();
        } else {
            $item = Item::find($itemId);
        }

        $winnersGemValue = winnersGemValue();

        return view('admin.items.index', compact('items', 'item', 'winnersGemValue'));
    }

    public function addItem(Request $request) {
        $request->validate([
            'name' => 'required|string',
        ]);

        $item = new Item();
        $item->name = $request->name;
        $item->type = 2;
        $item->package_id = 0;
        $item->center_price = 0;
        $item->mobile_price = 0;
        $item->distributors_price = 0;
        $item->suggested_retail_price = 0;
        $item->points_value = 0;
        $item->points_level_1 = 0;
        $item->points_level_2 = 0;
        $item->points_level_3 = 0;
        $item->points_level_4 = 0;
        $item->points_level_5 = 0;
        $item->points_level_6 = 0;
        $item->points_level_7 = 0;
        $item->points_level_8 = 0;
        $item->save();

        return response()->json([
            'redirect' => route('admin.items.index', ['item' => $item['id']])
        ]);
    }

    public function editItem(Request $request) {
        $request->validate([
            'id' => 'required',
            'name' => 'required|string',
            'type' => 'required|in:1,2',
            'status' => 'required|in:1,0',
        ]);

        $item = Item::find($request->id);

        abort_if(!$item, 422, 'Invalid Item');

        $file = $request->file('photo');
        if($file) {
            $name = $file->hashName();

            $path = $file->storeAs(
                config('filesystems.disks.do.folder') . '/items/' . $item['id'], $name, 'do'
            );

            $item->photo = config('filesystems.disks.do.cdn_endpoint') .$path;
        }

        $item->name = $request->name;
        $item->type = $request->type;
        $item->center_price = $request->center_price ?? $item['center_price'];
        $item->distributors_price = $request->distributors_price ?? $item['distributors_price'];
        $item->suggested_retail_price = $request->suggested_retail_price ?? $item['suggested_retail_price'];
        $item->points_value = $request->points_value ?? $item['points_value'];
        $item->status = $request->status;
        $item->update();

        return response()->json([
            'photo' => $item['photo']
        ]);
    }
}
