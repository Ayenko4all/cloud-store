<?php

namespace App\Http\Controllers\Admin;

use App\Brand;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BrandsController extends Controller
{
    /**
     * Display a listing of the brand resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return  view('admin.brands.index',['no'=>0, 'brands'=>Brand::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $title = 'Create Brand';
        return view('admin.brands.create',['title'=>$title]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required','string'],
        ]);
        $brands = Brand::create([
            'name' => $request->input('name')
        ]);

        $message = 'Brand added successfully';
        session()->flash('success', $message);
        return  redirect()->route('admin.brands.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Brand $brand
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Brand $brand)
    {
        $title = 'Edit Brand';
        return view('admin.brands.create',[
            'title'=>$title,
            'brandData'=>$brand
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Brand $brand
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Brand $brand)
    {
        $request->validate([
            'name' => ['required','string'],
        ]);
        $brand->update([
            'name' => $request->input('name')
        ]);
        $message = 'Brand updated successfully';
        session()->flash('success', $message);
        return  redirect()->route('admin.brands.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Brand $brand
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Brand $brand)
    {
        $brand->delete();
        $message = 'Brand has been deleted successfully!';
        session()->flash('success', $message);
        return redirect()->back();
    }

    /**
     * Update the specified  brand status resource from storage.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public  function status(Request $request){
        if ($request->ajax()){
            if ($request->input('status') == "Active"){
                $status = 0;
            }else{
                $status = 1;
            }
            Brand::find($request->input('data_id'))
                ->update(['status' => $status]);
            return response()->json(['status' => $status, 'data_id' => $request->input('data_id')]);
        }
    }
}
