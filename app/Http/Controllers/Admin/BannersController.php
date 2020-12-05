<?php

namespace App\Http\Controllers\Admin;

use App\Banner;
use App\Http\Controllers\Controller;
use App\Http\Requests\BannerFormRequest;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class BannersController extends Controller
{
    public function index(){
        return view('admin.banners.index',[
            'banners' => Banner::latest()->get(),
            'no' => 0,
        ]);
    }

    public function create(){
        return view('admin.banners.create',['title' => 'Add banner']);
    }

    public function store(BannerFormRequest $request){
        if ($request->isMethod('post')){
            $banner = new Banner();
            if ($request->hasFile('image')) {
                $image_tmp = $request->file('image');
                if ($image_tmp->isValid()) {
                    $extension = $image_tmp->getClientOriginalExtension();
                    $imgName = random_int(111, 99999) . '.' . $extension;
                    $imgPath = 'images/banner_image/' . $imgName;
                    Image::make($image_tmp)->save($imgPath);
                } else {
                    $imgName = "";
                }
            }
            $banner->insert([
                'title' => $request->input('title'),
                'alt'   => $request->input('alt'),
                'link'  => $request->input('link'),
                'image' => $imgName
            ]);
            session()->flash('success','Banner Image added successfully!');
            return redirect()->route('admin.banners.index');
        }
    }

    public function edit(Banner $banner){
        return view('admin.banners.create',['title' => 'Edit banner', 'bannerData' => $banner]);
    }

    public function update(BannerFormRequest $request, Banner $banner){
        if ($request->isMethod('patch')){
            if ($request->hasFile('image')) {
                $image_tmp = $request->file('image');
                if ($image_tmp->isValid()) {
                    $extension = $image_tmp->getClientOriginalExtension();
                    $imgName = random_int(111, 99999) . '.' . $extension;
                    $imgPath = 'images/banner_image/' . $imgName;
                    //Upload Image
                    Image::make($image_tmp)->save($imgPath);
                    $banner->image = $imgName;
                } else {
                    $imgName = "";
                }
            }

            $banner->update([
                'title' => $request->input('title'),
                'alt'   => $request->input('alt'),
                'link'  => $request->input('link'),
            ]);
            session()->flash('success','Banner Image updated successfully!');
            return redirect()->route('admin.banners.index');
        }

    }

    /**
     * Update the specified  banner status resource from storage.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public  function status(Request $request){
        //dd(request()->all());
        if ($request->ajax()){
            if ($request->input('status') == "Active"){
                $status = 0;
            }else{
                $status = 1;
            }
            Banner::find($request->input('data_id'))
                ->update(['status' => $status]);
            return response()->json(['status' => $status, 'data_id' => $request->input('data_id')]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Banner $banner
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($banner)
    {
        $bannerImage = Banner::select('id','image')->find($banner);
        if (file_exists('images/banner_image/'.$bannerImage->image)){
            unlink('images/banner_image/'.$bannerImage->image);
        }
        $bannerImage->delete();
        session()->flash('success', 'Banner has been deleted successfully!');
        return redirect()->route('admin.banners.index');
    }

    public function deleteBannerImage($banner){
        $bannerImage = Banner::select('id','image')->find($banner);
        //dd($bannerImage);
        if (file_exists('images/banner_image/'.$bannerImage->image)){
            unlink('images/banner_image/'.$bannerImage->image);
        }
        $bannerImage->update(['image'=>'']);
        session()->flash('success', 'Banner image has been deleted successfully!');
        return redirect()->back();
    }
}
