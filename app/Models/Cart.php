<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    function realtionwithProduct(){
        return $this->hasOne(Product::class, 'id', 'product_id');
    }
    function realtionwithColor(){
        return $this->hasOne(Color::class, 'id', 'color_id');
    }
    function realtionwithSize(){
        return $this->hasOne(Size::class, 'id', 'size_id');
    }

}
