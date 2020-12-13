<?php

namespace App\Providers;

use App\Banner;
use App\Brand;
use App\Product;
use App\Section;
use Illuminate\Support\ServiceProvider;

class MyServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

        view()->composer('admin.products.create', function ($view) {
            /*SECTION WITH CATEGORIES AND SUB CATEGORIES*/
            $categories = Section::with(['categories'])->get();
            $categories=json_decode(json_encode($categories), true);
            //dd($categories);
            $brands = Brand::where('status',1)->get();
            $view->with(['categories'=>$categories, 'brands'=>$brands, 'productFilters' => Product::productFilters()]);

        });

        view()->composer('layouts.front_layout._index_carousel', function ($view) {
            $banners = Banner::where('status' , 1)->where('image' ,'!=', '')->get()->toArray();
            $view->with(['banners'=>$banners]);
        });


    }
}
