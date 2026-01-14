<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $fillable = ["name", "description", "price", "available", "product_type", "image", "date", "time"];

    public function order_items()
    {
        return $this->hasMany(Order_Item::class);
    }
}
