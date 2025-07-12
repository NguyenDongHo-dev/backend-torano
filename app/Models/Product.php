<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'slug',
        'image_Id',
        'category_id',
        'status',
    ];


    protected static function boot()
    {
        parent::boot();

        static::creating(function ($product) {
            if (empty($product->slug)) {
                $product->slug = Str::slug($product->name);
            }
        });

        static::updating(function ($product) {
            if ($product->isDirty('name')) {
                $product->slug = Str::slug($product->name);
            }
        });
    }



    public function categories()
    {
        return $this->hasMany(Category::class);
    }


    public function images()
    {
        return $this->hasMany(Image::class);
    }


    public function productVariants()
    {
        return $this->belongsTo(Product_variant::class);
    }


    public function Review()
    {
        return $this->belongsTo(Riview::class);
    }


    public function Carts()
    {
        return $this->belongsTo(Cart::class);
    }


    public function Wishlist()
    {
        return $this->belongsTo(Wishlist::class);
    }


    
}
