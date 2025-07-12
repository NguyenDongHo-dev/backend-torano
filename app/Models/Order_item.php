<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_item extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'price',
    ];

    public function order(){
        return $this->belongsTo(Order::class);
    }

    
      public function productVariant(){
        return $this->belongsTo(product_Variant::class);
    }
}

