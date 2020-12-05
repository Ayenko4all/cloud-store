<?php

namespace App\Http\Controllers\Front;

use App\Category;
use App\Http\Controllers\Controller;
use App\Product;
use App\Section;
use Illuminate\Http\Request;

class ListingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param $url
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($url, Request $request)
    {
        if ($request->ajax()){
            $listings = Category::where(['url'=>$request->input('url') ,'status'=>1])->count();
            if ($listings > 0){
                $categoryDetails = Category::categoryDetails($request->input('url'));
                $categoryProduct = Product::whereIn('category_id',$categoryDetails['catIds'])
                    ->where(['status' => 1])->with('brand');
                /*check for sort option*/
                if(isset($_GET['sort'])&& !empty($_GET['sort'])){
                    switch($_GET['sort']){
                        case "product_latest":
                            $categoryProduct->latest();
                            break;
                        case "product_name_a_z":
                            $categoryProduct->orderBy('product_name','Asc');
                            break;
                        case "product_name_z_a":
                            $categoryProduct->orderBy('product_name','Desc');
                            break;
                        case "product_lowest_price":
                            $categoryProduct->orderBy('product_price','Asc');
                            break;
                        case "product_highest_price":
                            $categoryProduct->orderBy('product_price','Desc');
                            break;
                    }
                }

                $categoryProduct=$categoryProduct->simplePaginate(10);
                return  view('front.products.listings.product_ajax_listings')
                    ->with(compact('categoryDetails','categoryProduct','url'));
            }else{
                abort(404);
            }
        }else{
            $sections = Section::with('categories')->where(['status'=>1])->get();
            $listings = Category::where(['url'=>$url, 'status'=>1])->count();
            if ($listings > 0){
                $categoryDetails = Category::categoryDetails($url);
                $categoryProduct = Product::whereIn('category_id',$categoryDetails['catIds'])
                    ->where(['status' => 1])->with('brand');
                $categoryProduct=$categoryProduct->simplePaginate(10);
                return  view('front.products.listings.index')
                    ->with(compact('sections','categoryDetails','categoryProduct','url'));
            }else{
                abort(404);
            }
        }

    }


}
