<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    // Start: Relationships
    public function orderedItems() {
        return $this->hasMany(OrderedItem::class);
    }
    // End: Relationships

    public function photo() {
        return ($this->photo) ?? config('app.url') . '/img/items/default-item-image.png';
    }

    public function longestDimension() {
//        list($width, $height) = getimagesize(str_replace(' ', '%20', $this->photo));
//
//        $this->dimension = json_encode([$width, $height]);
//        $this->update();

        $dimension = json_decode($this->dimension, true);

        return (($dimension[0] >= $dimension[1]) ? "width" : "height");
    }

    public function terminalItemStock($userId, $stockist) {
        $terminalItemStock['total'] = $this->orderedItems()
            ->join('orders', function($join) use ($userId, $stockist) {
                $join->whereNotNull('date_time_completed');
                $join->where('user_id', $userId);
                $join->where('stockist', $stockist);
            })
            ->sum('quantity');

        $terminalItemStock['ordered'] = $this->orderedItems()
            ->join('orders', function($join) use ($userId) {
                $join->whereNotNull('date_time_completed');
                $join->where('terminal_user_id', $userId);
            })
            ->sum('quantity');

        $terminalItemStock["inStock"] = $terminalItemStock["total"] - $terminalItemStock["ordered"];

        $terminalItemStock['pending'] = $this->orderedItems()
            ->join('orders', function($join) use ($userId) {
                $join->whereNull('date_time_completed');
                $join->where('terminal_user_id', $userId);
            })
            ->sum('quantity');

        return $terminalItemStock;
    }

}
