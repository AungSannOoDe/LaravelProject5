<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\order;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class adminController extends Controller
{
    public function editProfile(){
        return view('Admin.account.edit');
    }
    public function  updateuser($id){
        $edit=user::where('id',$id)->get();
       return view('Admin.account.usereditprofile',compact('edit'));
    }
    public function adminlist(){
        $admin=User::when(request('key'),function($query){
      $query->orWhere('name','like','%'.request('key').'%')
      ->orWhere('address','like','%'.request('key').'%')
      ->orWhere('phone','like','%'.request('key').'%')
      ->orWhere('email','like','%'.request('key').'%')
      ;
        })
        ->where('role','admin')
        ->orderBy('created_at','asc')
        ->paginate(2);
  $admin->appends(request()->all());
        return view('Admin.account.list',compact('admin'));
    }
    public function userlist(){
       $users= User::where('role','user')->get();

        return view('Admin.user.userlist',compact('users'));
    }
    public function usersProfile($id){
        $users=user::where('id',$id)->get();
        return view('Admin.account.usersProfile',compact('users'));
    }
    public function userRole(Request $request){
        $data=$this->getRoleChangeData($request);
       $user= User::where('id',$request->userId)->update($data);
       return response()->json($user,200);
    }
    public function adminaccdelete($id){
         User::where('id',$id)->delete();
         return back()->with(['deleteSuccess'=>'Your Admin Account delete Successfully']);
    }
    public function adminOrder(){
        $order=order::select('orders.*','users.name as user_name')
          ->leftjoin('users','users.id','orders.user_id')->orderBy('created_at','desc')
          ->get();
        return view('Admin.Order.order',compact('order'));
    }
    public function update(Request $request,$id){
       $this->accountValidationCheck($request);
       $data=$this->getUserData($request);
       if($request->has('image')){
        $dbImage=User::Where('id',$id)->first();
        $dbImage=$dbImage->image;
        if($dbImage !=null){
            Storage::delete('public/'.$dbImage);
        }
        $filename=uniqid().$request->file('image')->getClientOriginalName();
        $request->file('image')->storeAs('public',$filename);
        $data['image']=$filename;
       }
       User::where('id',$id)->update($data);
       if(Auth::user()->id==$id){
        return redirect()->route('admin#details')->with(['updateSuccess'=>'Update is successful']);
       }
       else{
        return redirect()->route('admin#usersProfile',$id)->with(['updateSuccess'=>'Update is successful']);
       }
    }
    private function getUserData($request){
        return[
 'name'=>$request->name,
 'email'=>$request->email,
 'address'=>$request->address,
 'phone'=>$request->phone,
 'updated_at'=>Carbon::now()
        ];
    }
    private function accountValidationCheck($request){
        Validator::make($request->all(),[
            'name'=>'required'
            ,'image'=>'mimes:jgg,png,jpeg|file'
            ,'email'=>'required'
            ,'address'=>'required'
            ,'phone'=>'required'
        ])->validate();
    }
    private  function getRoleChangeData($request){
        return[
            'role'=>$request->role
        ];
    }
}

