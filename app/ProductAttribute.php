<?php

namespace App;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;

class ProductAttribute extends Model
{
    use Uuids;
    protected $guarded = [];


}
