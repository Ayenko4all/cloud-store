<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $guarded = [];

    public static  function getBanners(){
        $banners = self::where(['status' => 1])->get()->toArray();
        dd($banners);
        return view('layouts.front_layout._index_carousel',['banners'=>$banners]);
    }

}
