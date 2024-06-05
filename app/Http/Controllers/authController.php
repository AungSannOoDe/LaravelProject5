<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class authController extends Controller
{
    public function loginPage(){
        return view('loginPage');
    }
    public function registerPage(){
        return view('registerpage');
    }

    //Change Password
    public function Change( Request $request){
$this->CheckPasswordValidation($request);
$user=User::select('password')->where('id',Auth::user()->id)->first();
$hashValue=$user->password;
if(Hash::check($request->oldPassword, $hashValue)){
    $data=[
   'password'=>Hash::make($request->newPassword)
    ];

    User::where('id',Auth::user()->id)->update($data);
    Auth::logout();
    return back()->with(['Success'=>"Change password is success"]);
}

    return back()->with(['notMatch'=>'Old password not match Try again...']);

}
    public function dashboard(){
        if(Auth::user()->role=="admin"){
           return redirect()->route('admin#cate');
        }
        else{
             return  redirect()->route('user#cate');
        }
    }
    public function changePage(){
        return view('Admin.account.change');
    }
    //admin details
    public function details(){
        
        return view('Admin.account.details');
    }
   private function CheckPasswordValidation($request){
        Validator::make($request->all(),[
            'oldPassword'=>'required|min:8',
            'newPassword'=>'required|min:8',
            'Confirm'=>'required|min:8|same:newPassword'
        ])->validate();
   }
}
