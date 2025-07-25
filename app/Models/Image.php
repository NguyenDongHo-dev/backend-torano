<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;


    protected $fillable = [
        'url',
    ];

    public function product(){
        return $this->hasMany(Product::class);
    }   

     public function Product_variant(){
        return $this->hasMany(Product_variant::class);
    }     
}
