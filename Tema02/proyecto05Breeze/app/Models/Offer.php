<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    //
    protected $fillable = ['date','time','product_id'];

    public function products() {
        
        return $this->belongsToMany(Product::class);
    }
}
