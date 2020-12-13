<?php

namespace App;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use Uuids;
    protected $guarded = [];

    public function products(){
        $this->hasMany(Product::class,'product_id');
    }
}
