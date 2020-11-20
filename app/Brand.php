<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $guarded = [];

    public function products(){
        $this->hasMany(Product::class,'product_id');
    }
}
