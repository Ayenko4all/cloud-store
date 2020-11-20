<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Product;
use App\ProductsImage;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ProductImagesController extends Controller
{
    public function store(Request $request,$id){
        $title='Product Images';
        $productData = Product::with('product_images')
            ->select(['id','product_name','product_code','product_color','main_image'])
            ->findOrfail($id);
        //$productData = json_decode(json_encode($productData, true));
        if ($request->isMethod('post')){
            //dd($request->all());
            if ($request->hasFile('images')){
                $images_tmp = $request->file('images');
                foreach ($images_tmp as $key => $image){
                    $productImage = new ProductsImage();
                    if ($image->isValid()){
                        //Get Image Extension
                        $extension = $image->getClientOriginalExtension();
                        //Generate New Image Name
                        $imgName =  random_int(111,99999). '.'.$extension;
                        $imgPath = 'images/product_image/large/'.$imgName;
                        $imgPathMedium = 'images/product_image/medium/'.$imgName;
                        $imgPathSmall = 'images/product_image/small/'.$imgName;
                        //Upload Image
                        Image::make($image)->save($imgPath);
                        Image::make($image)->resize(500,600)->save($imgPathMedium);
                        Image::make($image)->resize(250,300)->save($imgPathSmall);
                        $productImage->image = $imgName;
                        $productImage->product_id = $id;
                        $productImage->save();
                    }else{$imgName = "";}
                }
                $message = 'Product Image added successfully!';
                session()->flash('success', $message);
                return redirect()->back();
            }
        }

        return view('admin.products.product_images',[
            'no'=>0,
            'title'=>$title,
            'productData'=>$productData
        ]);
    }

    public function delete($id){
        $productImage = ProductsImage::find($id)->delete();
        if (!empty($productImage->image)){
            if (file_exists('images/product_image/large'.$productImage->image)
                ||file_exists('images/product_image/medium/'.$productImage->image)
                ||file_exists('images/product_image/small/'.$productImage->image)){
                unlink('images/product_image/large/'.$productImage->image);
                unlink('images/product_image/medium/'.$productImage->image);
                unlink('images/product_image/small/'.$productImage->image);
            }
        }
        $message = 'Product Image has been deleted successfully!';
        session()->flash('success', $message);
        return redirect()->back();
    }

    public  function status(Request $request){
        if ($request->ajax()){
            if ($request->input('status') == "Active"){
                $status = 0;
            }else{
                $status = 1;
            }
            ProductsImage::where('id', $request->input('data_id'))
                ->update(['status' => $status]);
            return response()->json(['status' => $status, 'data_id' => $request->input('data_id')]);
        }
    }

    //    public function updateImages(Request $request,$id){
//        $productData = Product::with('product_images')
//            ->select(['id','product_name','product_code','product_color','main_image'])
//            ->findOrfail($id);
//        //$productData = json_decode(json_encode($productData, true));
//        if ($request->isMethod('post')){
//            $data= $request->all();
//            if ($request->hasFile('images')){
//                $images_tmp = $request->file('images');
//                foreach ($images_tmp as $key => $image){
//                    if ($image->isValid()){
//                        //Get Image Extension
//                        $extension = $image->getClientOriginalExtension();
//                        //Generate New Image Name
//                        $imgName =  random_int(111,99999). '.'.$extension;
//                        $imgPath = 'images/product_image/large/'.$imgName;
//                        $imgPathMedium = 'images/product_image/medium/'.$imgName;
//                        $imgPathSmall = 'images/product_image/small/'.$imgName;
//                        //Upload Image
//                        Image::make($image)->save($imgPath);
//                        Image::make($image)->resize(500,600)->save($imgPathMedium);
//                        Image::make($image)->resize(250,300)->save($imgPathSmall);
//                        $productImage = ProductsImage::where(['product_id'=>$id,'id'=>$data['product_images_id'][$key]])->update(['image'=>$imgName]);
//                    }else{$imgName = "";}
//                }
//                $message = 'Product Image added successfully!';
//                session()->flash('success', $message);
//                return redirect()->back();
//            }
//        }
//
//        return view('admin.products.product_images',[
//            'no'=>0,
//            'title'=>$title,
//            'productData'=>$productData
//        ]);
//    }
}
