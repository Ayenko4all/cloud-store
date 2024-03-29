<?php

namespace App;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;


class Product extends Model
{
    use Uuids;
    protected $guarded = [];

    public function category(){
        return $this->belongsTo(Category::class,'category_id');
    }

    public function section(){
        return $this->belongsTo(Section::class,'section_id');
    }

    public function brand(){
        return $this->belongsTo(Brand::class,'brand_id');
    }

    public function attributes(){
        return $this->hasMany(ProductAttribute::class, 'product_id');
    }

    public function product_images(){
        return $this->hasMany(ProductsImage::class, 'product_id');
    }

    public static  function featureCount(){
        return self::where('is_featured','YES')->count();
    }

    public static function productFilters(){
        $productFilters['fabricArray']      = ['Cotton', 'Polyester', 'Wool'];
        $productFilters['sleeveArray']      = ['Full Sleeve', 'Half Sleeve', 'Short Sleeve'];
        $productFilters['patternArray']     = ['Checked', 'Plain', 'Printed', 'Self', 'Solid'];
        $productFilters['fitArray']         = ['Regular', 'Slim'];
        $productFilters['occasionArray']    = ['Casual', 'Formal'];
        return $productFilters;
    }

}
