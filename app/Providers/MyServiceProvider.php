<?php

namespace App\Providers;

use App\Banner;
use App\Brand;
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
            /*FILTER ARRAYS*/
            $fabricArray = ['Cotton', 'Polyester', 'Wool'];
            $sleeveArray = ['Full Sleeve', 'Half Sleeve', 'Short Sleeve'];
            $patternArray = ['Checked', 'Plain', 'Printed', 'Self', 'Solid'];
            $fitArray = ['Regular', 'Slim'];
            $occasionArray = ['Casual', 'Formal'];
            /*SECTION WITH CATEGORIES AND SUB CATEGORIES*/
            $categories = Section::with(['categories'])->get();
            $categories=json_decode(json_encode($categories), true);
            $brands = Brand::where('status',1)->get();
            $view->with([
                'fabricArray'=>$fabricArray, 'sleeveArray'=>$sleeveArray,
                'patternArray'=>$patternArray, 'fitArray'=>$fitArray, 'occasionArray'=>$occasionArray,
                'categories'=>$categories,
                'brands'=>$brands
            ]);

        });

        view()->composer('layouts.front_layout._index_carousel', function ($view) {
            $banners = Banner::where('status' , 1)->where('image' ,'!=', '')->get()->toArray();
            //dd($banners);
            $view->with(['banners'=>$banners]);
        });
    }
}
