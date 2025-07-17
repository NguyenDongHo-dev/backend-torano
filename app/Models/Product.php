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
        'image_id',
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



    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }


    public function image()
    {
        return $this->belongsTo(Image::class,'image_id');
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

     public function product_images()
    {
        return $this->belongsTo(Product_image::class);
    }


    
}
