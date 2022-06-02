<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Observers\UserObserver;
class Order extends Model
{
    use HasFactory;
    
    protected $fillable = ['account_name', 'account_number', 'order_number', 'order_date'];

    public function ordered_products(){
        return $this->hasMany(OrderedProduct::class);
    }
}