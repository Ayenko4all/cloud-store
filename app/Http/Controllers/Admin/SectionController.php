<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    public function index(){
        return view('admin.sections.index',['sections' => Section::all(), 'no'=>0]);
    }

    public  function status(Request $request){
        if ($request->ajax()){
           if ($request->input('status') == "Active"){
               $status = 0;
           }else{
               $status = 1;
           }
            Section::find( $request->input('data_id'))
                ->update(['status' => $status]);
           return response()->json(['status' => $status, 'data_id' => $request->input('data_id')]);
        }
    }
}
