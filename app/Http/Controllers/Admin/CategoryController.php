<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Section;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{
    public function index(){

        $categories = Category::with('section','parentCategory')->get();
        return view('admin.categories.categories',['categories' => $categories, 'no'=>0]);
    }

    public  function updateCategoryStatus(Request $request){
        if ($request->ajax()){
            if ($request->input('status') == "Active"){
                $status = 0;
            }else{
                $status = 1;
            }
            Category::find($request->input('data_id'))
                ->update(['status' => $status]);
            return response()->json(['status' => $status, 'data_id' => $request->input('data_id')]);
        }
    }

    public function addUpdateCategory(Request $request, $id=null){
        if (empty($id)){
            //Add Category
            $title = "Add Category";
            $category = new Category();
            $categoryData = [];
            $getCategories = [];
            $message = 'Category added successfully';
        }else{
            //Edit Category
            $title = "Edit Category";
            $message = 'Category updated successfully';
            $categoryData = Category::where('id',$id)->first();
            $categoryData=json_decode(json_encode( $categoryData), true);
            $getCategories = Category::with('subcategories')->where(['parent_id' => 0,'section_id'=>$categoryData['section_id']])->get();
            $getCategories=json_decode(json_encode($getCategories), true);
            $category = Category::find($id);

        }
        if ($request->isMethod('post')){
            $data = $request->all();
            $request->validate([
                'section_id' => ['required','string'],
                'category_name' => ['required','string'],
                 'image'        => ['image'],
                'url' => ['required','string'],
            ]);
            if ($request->hasFile('image')) {
                $image_tmp = $request->file('image');
                if ($image_tmp->isValid()){
                    //Get Image Extension
                    $extension = $image_tmp->getClientOriginalExtension();
                    //Generate New Image Name
                    $imgName = random_int(111,99999). '.'.$extension;
                    $imgPath = 'images/category_image/'.$imgName;
                    //Upload Image
                    Image::make($image_tmp)->resize(300,400)->save($imgPath);
                    $category->image = $imgPath;
                }else{$imgName = "";}
            }
            $category->parent_id = $data['parent_id'];
            $category->section_id = $data['section_id'];
            $category->category_name = $data['category_name'];
            $category->description = $data['description'];
            $category->category_discount = $data['category_discount'];
            $category->meta_title = $data['meta_title'];
            $category->meta_description = $data['meta_description'];
            $category->meta_keywords = $data['meta_keywords'];
            $category->url = $data['url'];
            $category->save();
            session()->flash('success', $message);
            return redirect()->route('categories');
        }

        return view('admin.categories.create', [
                'getSections' => Section::get(),
                'categoryData'=> $categoryData,
                'title'=>$title,
                'getCategories'=> $getCategories
            ]);
    }

    public  function appendCategoriesLevel(Request $request){
        if ($request->ajax()){
          $getCategories = Category::where(['section_id'=> $request->input('section_id'), 'parent_id' => 0, 'status' => 1])
              ->with('subcategories')->get();
            return view('admin.categories.append_categories_level', ['getCategories'=>$getCategories->toArray()]);
        }
    }

    public function deleteCatgeoryImage($id){
        $categoryImage = Category::select('image')->where('id',$id)->first();
        if (file_exists($categoryImage->image)){
            unlink($categoryImage->image);
        }
        Category::where('id',$id)->update(['image'=>'']);
        $message = 'Category image has been deleted successfully!';
        session()->flash('success', $message);
        return redirect()->back();
    }

    public function deleteCategory($id){
        Category::find($id)->delete();
        $message = 'Category has been deleted successfully!';
        session()->flash('success', $message);
        return redirect()->back();
    }
}
