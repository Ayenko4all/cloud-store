<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Product;
use App\ProductAttribute;
use Illuminate\Http\Request;

class ProductAttributesController extends Controller
{
    public function store(Request $request, $id){
        $title='Product Attributes';
        $productData = Product::with('attributes')->find($id);
        if ($request->isMethod('post')) {
            for($count = 0, $countMax = count($request->input('size')); $count < $countMax; $count++)
            {
                $record = array(
                    'product_id' => $id,
                    'size' => $request->input('size')[$count],
                    'sku'  => $request->input('sku')[$count],
                    'stock'  => $request->input('stock')[$count],
                    'price'  => $request->input('price')[$count]
                );
                $size= ProductAttribute::select('id','size','sku')->where(['product_id'=>$id,'size'=>$record['size']])->count();
                $sku=ProductAttribute::select('id','size','sku')->where(['product_id'=>$id,'sku'=>$record['sku']])->count();
                if ($size>0 || $sku>0){
                    session()->flash('error', 'Size or Sku attribute already exist for this product');
                    return redirect()->back();
                }

                $attribute= new ProductAttribute();
                $attribute->product_id = $record['product_id'];
                $attribute->sku = $record['sku'];
                $attribute->stock = $record['stock'];
                $attribute->size = $record['size'];
                $attribute->price = $record['price'];
                $attribute->save();
            }
            session()->flash('success', 'Product Attribute added successfully');
            return redirect()->back();
        }
        return view('admin.products.attribute',[
            'productData'=>$productData,
            'title'=>$title,
            'no'=>0
        ]);
    }

    public function update(Request $request,$id){
        if ($request->isMethod('patch')){
            for($count = 0, $countMax = count($request->input('attribute_id')); $count < $countMax; $count++)
            {
                $record = array(
                    'product_id' => $id,
                    'attribute_id'  => $request->input('attribute_id')[$count],
                    'stock'  => $request->input('stock')[$count],
                    'price'  => $request->input('price')[$count]
                );
                ProductAttribute::where(['id'=>$record['attribute_id']])
                    ->update(['stock'=>$record['stock'],'price'=>$record['price']]);
            }
            session()->flash('success', 'Product Attribute updated successfully');
            return redirect()->back();
        }
    }

    public function delete($id){
        $productAttribute = ProductAttribute::where('id',$id)->first();
        $productAttribute->delete();
        $message = 'Product Attribute has been deleted successfully!';
        session()->flash('success', $message);
        return redirect()->back();
    }

    public  function updateProductAttributeStatus(Request $request){
        if ($request->ajax()){
            if ($request->input('status') == "Active"){
                $status = 0;
            }else{
                $status = 1;
            }
            ProductAttribute::where('id', $request->input('data_id'))
                ->update(['status' => $status]);
            return response()->json(['status' => $status, 'data_id' => $request->input('data_id')]);
        }
    }
}
