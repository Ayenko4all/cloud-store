<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Product;
use App\ProductAttribute;
use App\Section;
use Illuminate\Http\Request;

class ProductsController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @param Product $product
     * @param $code
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show($product, $code)
    {
        $sections = Section::with('categories')->where(['status'=>1])->get();
        $productDetail = Product::with(['category','section','brand','attributes','product_images'])->find($product);
        $stock = ProductAttribute::where('product_id',$product)->sum('stock');
        $randomProducts = Product::where(['status'=>1,'category_id'=>$productDetail->category->id])
            ->where('id','!=',$product)->inRandomOrder()->limit(3)->get();
        //dd($randomProducts);
        return view('front.products.details.show')->with(compact(['productDetail','sections','stock','randomProducts']));
    }

    public function getProductPriceBySize(Request $request){
        if ($request->ajax()){
            $data = $request->all();
          $getProductPriceBySize = ProductAttribute::where(['product_id'=>$data['id'],'size'=>$data['size']])->first();
          return response()->json(['getProductPriceBySize'=>$getProductPriceBySize]);
        }
    }

    public function checkProductQty(Request $request){
        if ($request->ajax()){
            $data = $request->all();
            dd($data);
            $getProductQty = ProductAttribute::where(['product_id'=>$data['id'],'stock'=>$data['qty']])->first();
            if ($getProductQty)
            dd($getProductQty->stock);
            return response()->json(['getProductQty'=>$getProductQty->stock]);
        }

    }


}
