<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderedProduct extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'sku', 'amount', 'quantity', 'order_id'];

    public function order(){
        return $this->belongsTo(Order::class);
    }
}
