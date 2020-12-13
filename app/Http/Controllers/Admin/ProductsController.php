<?php

namespace App\Http\Controllers\Admin;

use App\Brand;
use App\Category;
use App\Http\Controllers\Controller;
use App\Product;
use App\ProductAttribute;
use App\ProductsImage;
use App\Section;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;


class ProductsController extends Controller
{
    public function index(){
        $products = Product::with(['category'=>function($query){$query->select(['id','category_name']);},
            'section','brand'])->get();
        return view('admin.products.index', ['products'=>$products, 'no'=>0]);
    }

    public function create(){
        $title = "Add Product";
        return view('admin.products.create', ['title'=>$title,'productData'=> $productData =[]]);
    }

    public function edit(Product $product){
        $title = "Edit Product";
        $productData=json_decode(json_encode($product), true);
        return view('admin.products.create', ['title'=>$title, 'productData'=>$productData]);
    }

    public function store(Request $request){
        $message = 'Product added successfully';
        $product = new Product();
        if ($request->isMethod('post')){
            return $this->process_data($request, $product, $message);
        }
    }

    public function update(Request $request,Product $product){
        $message = 'Product was updated successfully';
        if ($request->isMethod('patch')){
            return $this->process_data($request, $product, $message);
        }

    }

    public function destroy($product){
        $product = Product::find($product);
        if (!empty($product->main_image)){
            if (file_exists('images/product_image/large'.$product->main_image)
                ||file_exists('images/product_image/medium/'.$product->main_image)
                ||file_exists('images/product_image/small/'.$product->main_image)){
                unlink('images/product_image/large/'.$product->main_image);
                unlink('images/product_image/medium/'.$product->main_image);
                unlink('images/product_image/small/'.$product->main_image);
            }elseif (file_exists('videos/product_video/'.$product->product_video)){
                unlink('videos/product_video/'.$product->product_video);
            }
        }
        ProductAttribute::where('product_id',$product->id)->delete();
        ProductsImage::where('product_id',$product->id)->delete();
        $product->delete();
        $message = 'Product has been deleted successfully!';
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
            Product::where('id', $request->input('data_id'))
                ->update(['status' => $status]);
            return response()->json(['status' => $status, 'data_id' => $request->input('data_id')]);
        }
    }

    public function deleteProductImage($id)
    {
        $product = Product::select(['id','main_image'])->find($id);
        if (!empty($product->main_image)){
                if (file_exists('images/product_image/large'.$product->main_image)
                    ||file_exists('images/product_image/medium/'.$product->main_image)
                    ||file_exists('images/product_image/small/'.$product->main_image)){
                    unlink('images/product_image/large/'.$product->main_image);
                    unlink('images/product_image/medium/'.$product->main_image);
                    unlink('images/product_image/small/'.$product->main_image);
                }
        }
        $product->update(['main_image' => '']);
        $message = 'Product image has been deleted successfully!';
        session()->flash('success', $message);
        return redirect()->back();
    }

    public function deleteProductVideo($id){
        $product = Product::select(['id','product_video'])->find($id);
        if (!empty($product->product_video)){
            if (file_exists('videos/product_video/'.$product->product_video)){
                unlink('videos/product_video/'.$product->product_video);
            }
        }
        $product->update(['product_video'=>'']);
        $message = 'Product video has been deleted successfully!';
        session()->flash('success', $message);
        return redirect()->back();
    }

    /**
     * @param Request $request
     * @param $product
     * @param string $message
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Intervention\Image\Exception\NotWritableException
     * @throws \Symfony\Component\HttpFoundation\File\Exception\FileException
     */
    protected function process_data(Request $request, $product, string $message): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'category_id' => ['required', 'string'],
            'brand_id' => ['required', 'string'],
            'product_name' => ['required', 'string'],
            'product_color' => ['required', 'string'],
            'product_code' => ['required', 'string'],
            'product_price' => ['required', 'numeric'],
        ]);

        if ($request->hasFile('main_image')) {
            $image_tmp = $request->file('main_image');
            if ($image_tmp->isValid()) {
                //Get Image Extension
                $extension = $image_tmp->getClientOriginalExtension();
                $image_original_name = $image_tmp->getClientOriginalName();
                //Generate New Image Name
                $imgName = $image_original_name . '-' . random_int(111, 99999) . '.' . $extension;
                $imgPath = 'images/product_image/large/' . $imgName;
                $imgPathMedium = 'images/product_image/medium/' . $imgName;
                $imgPathSmall = 'images/product_image/small/' . $imgName;
                //Upload Image
                Image::make($image_tmp)->save($imgPath);
                Image::make($image_tmp)->resize(500, 500)->save($imgPathMedium);
                Image::make($image_tmp)->resize(250, 250)->save($imgPathSmall);
                $product->main_image = $imgName;
            } else {
                $imgName = "";
            }
        }

        if ($request->hasFile('product_video')) {
            $video_tmp = $request->file('product_video');
            if ($video_tmp->isValid()) {
                //Get Image Extension
                $extension = $video_tmp->getClientOriginalExtension();
                $video_original_name = $video_tmp->getClientOriginalName();
                //Generate New Image Name
                $videoName = $video_original_name . '-' . random_int(111, 99999) . '.' . $extension;
                //$videoPath = 'videos/product_video/';
                //Upload Video
                $videoPath = $video_tmp->move('videos/product_video/', $videoName);
                $product->product_video = $videoName;
            } else {
                $videoName = "";
            }
        }
        //dd($request->all());

        $categoryDetail = Category::find($request->input('category_id'));
        $product->section_id = $categoryDetail->section_id;
        $product->category_id = $request->input('category_id');
        $product->brand_id = $request->input('brand_id');
        $product->product_code = $request->input('product_code');
        $product->product_name = $request->input('product_name');
        $product->product_price = !empty($request->input('product_price')) ? $request->input('product_price') : 0;
        $product->product_color = $request->input('product_color');
        $product->product_discount = !empty($request->input('product_discount')) ? $request->input('product_discount') : 0;
        $product->product_weight = !empty($request->input('product_weight')) ? $request->input('product_weight') : 0;
        $product->description = $request->input('description');
        $product->wash_care = $request->input('wash_care');
        $product->fabric = $request->input('fabric');
        $product->pattern = $request->input('pattern');
        $product->sleeve = $request->input('sleeve');
        $product->fit = $request->input('fit');
        $product->occasion = $request->input('occasion');
        $product->meta_title = $request->input('meta_title');
        $product->meta_description = $request->input('meta_description');
        $product->meta_keywords = $request->input('meta_keywords');
        $product->is_featured = !empty($request->input('is_featured')) ? $request->input('is_featured') : 'No';
        $product->save();
        session()->flash('success', $message);
        return redirect()->route('admin.products.index');
    }


}
