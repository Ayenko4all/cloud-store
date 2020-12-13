<?php

namespace App;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;

class ProductsImage extends Model
{
    use Uuids;
    protected $guarded = [];
}
