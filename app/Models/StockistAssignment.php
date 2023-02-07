<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockistAssignment extends Model
{
    use HasFactory;

    public function stockistUser() {
        return $this->belongsTo(User::class, 'stockist');
    }
}
