<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
use Session;
use App\Admin;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.admin_dashboard');
    }
    public  function settings(){
        $adminDetails = Admin::where('email',Auth::guard('admin')->user()->email)->first();
        return view('admin.admin_settings')->with(compact('adminDetails'));
    }
    public function login(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();

            $rules = [
                'email' => 'required|email|max:255',
                'password' => 'required',
            ];
            $customMessages = [
              'email.required' => 'Email is required.',
              'email.email' => 'Valid Email is required.',
              'password.required' => 'Password is required.',
            ];
            $this->validate($request,$rules,$customMessages);

            if (Auth::guard('admin')->attempt(['email' => $data['email'], 'password' => $data['password']])) {
                return redirect('/admin/dashboard#/dashboard');
            } else {
                Session::flash('error_message','Invalid Email or Password!');
                return redirect()->back();
            }
        }
        return view('admin.admin_login');
    }
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('/admin');
    }
    public function chkCurrentPassword(Request $request){
        $data =$request->all();
        if(Hash::check($data['current_pwd'], Auth::guard('admin')->user()->password)){
            echo "true";
        }else{
            echo "false";
        }
    }
    public function updateCurrentPassword(Request $request){
        if($request->isMethod('post')){
            $data=$request->all();
            $rules = [
                'current_pwd' => 'required',
                'new_pwd' => 'required',
                'confirm_pwd' => 'required'

            ];
            $customMessages = [
                'current_pwd.required' => 'Current password is required.',
                'new_pwd.required' => 'New password is required.',
                'confirm_pwd.required' => 'Confirm password is required.',
            ];
            $this->validate($request,$rules,$customMessages);
            //Check if current password is correct
            if(Hash::check($data['current_pwd'], Auth::guard('admin')->user()->password)){
                if($data['new_pwd']==$data['current_pwd'] && $data['confirm_pwd']==$data['current_pwd']){
                    Session::flash('error_message','Try new password, this password is used!');
                    return redirect()->back();
                }
                //Check if new password and confirm password is matching
                else if($data['new_pwd']==$data['confirm_pwd']){
                    Admin::where('id',Auth::guard('admin')->user()->id)
                        ->update(['password'=>bcrypt($data['new_pwd'])]);
                    Session::flash('success_message','Password has been updated successfully!');

                }else{
                    Session::flash('error_message','New password and Confirm password does not match!');
                    return redirect()->back();
                }
            }else{
                Session::flash('error_message','Your current password  is incorrect!');
                return redirect()->back();
            }
            return redirect()->back();
        }
    }
}
