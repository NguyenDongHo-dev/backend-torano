<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_variant extends Model
{
    use HasFactory;

     protected $fillable = [
        'product_id',
        'size_id',
        'color_id',
        'stock',
        'imahge_id',
    ];

    public function color()
    {
        return $this->hasMany(Color::class);
    }

    public function size()
    {
        return $this->hasMany(Size::class);
    }

    public function product()
    {
        return $this->hasMany(Product::class);
    }
}
