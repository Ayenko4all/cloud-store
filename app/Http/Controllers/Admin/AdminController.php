<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class AdminController extends Controller
{
    public function index(){
        return view('admin.admin_dashboard');
    }

    public function login(Request $request){
        if ($request->isMethod('post')){
            $request->validate([
                'email' => ['required','email'],
                'password' => ['required','min:6']
            ]);
            $data = $request->all();
            if (Auth::guard('admin')->attempt(['email' => $data['email'], 'password' => $data['password']])){
                return redirect('admin/dashboard');
            }else{
                session()->flash('error', 'Invalid Email or Password');
                return redirect()->back();
            }
        }
        return view('admin.admin_login');
    }

    public function settings(){
        $admin = Auth::guard('admin')->user();
        return view('admin.admin_settings',['admin' => $admin]);
    }

    public function chkCurrentPassword(Request $request){
        $data = $request->all();
        if (Hash::check($data['current_pwd'], Auth::guard('admin')->user()->password)){
            echo  "true";
        }else{
            echo "false";
        }
    }

    public function updateCurrentPassword(Request $request){
        if ($request->isMethod('post')){
            $request->validate([
                'password' => ['required','confirmed','min:6','different:current_pwd'],
            ]);
            if (Hash::check($request->input('current_pwd'), Auth::guard('admin')->user()->password)){
                Auth::guard('admin')->user()->update([
                    'password' => Hash::make($request->input('password'))
                ]);
                session()->flash('success', 'Password has been updated successfully');
                return redirect()->back();
            }else{
                session()->flash('error', 'Current password is incorrect');
                return redirect()->back();
            }
        }
    }

    public function updateProfile(Request $request){
        $admin = Auth::guard('admin')->user();
        if ($request->isMethod('post')){
            $this->validateInput($request, $admin);
            $admin->update([
                'name' => $request->input('name'),
                'mobile' => $request->input('mobile'),
            ]);

            session()->flash('success', 'Profile has been updated successfully');
            return redirect()->back();
        }
        return view('admin.admin_profile',['admin' => $admin]);
    }

    public function logout(){
        Auth::guard('admin')->logout();
        return redirect('/admin');
    }

    /**
     * @param Request $request
     * @param \Illuminate\Contracts\Auth\Authenticatable|null $admin
     */
    protected function validateInput(Request $request, ?\Illuminate\Contracts\Auth\Authenticatable $admin): void
    {
        $request->validate([
            'name' => ['required', 'string', 'regex:/^[\pL\s\-]+$/u'],
            'mobile' => ['required', 'digits:11'],
            'image' => ['image','max:3048']
        ]);
        if ($request->hasFile('image')) {
            $image_tmp = $request->file('image');
            if ($image_tmp->isValid()){
                //Get Image Extension
                $extension = $image_tmp->getClientOriginalExtension();
                //Generate New Image Name
                $imgName = random_int(111,99999). '.'.$extension;
                $imgPath = 'images/admin_image/admin_photos/'.$imgName;
                //Upload Image
                Image::make($image_tmp)->resize(300,400)->save($imgPath);
                $admin->update(['image' =>  $imgPath]);
            }else{$imgName = "";}
        }
    }


}
