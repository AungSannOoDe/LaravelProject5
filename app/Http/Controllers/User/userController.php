<?php

namespace App\Http\Controllers\User;

use App\Models\cart;
use App\Models\User;
use App\Models\order;
use App\Models\product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use App\Models\contact;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class userController extends Controller
{
    public function Page(){
        $pizza=product::orderBy('created_at','desc')->get();
        $category=Category::get();
        $cart=cart::where('user_id',Auth::user()->id)->get();
        $history=order::where('user_id',Auth::user()->id)->get();
        return view('user.main.user',compact('pizza','category','cart','history'));
    }

    public function ChangePage(){
        return view('user.account.ChangeAccount');
    }
    public function details(){
        return view('user.account.details');
    }
    public function profile(){
        return view('user.account.editAcc');
    }
    public function detailsPage($id){
         $pizza=product::where('id',$id)->first();
         $pizzalist=product::get();
     return view('user.cart.details',compact('pizza','pizzalist'));
  }
  public function Cart(){
    $carts=cart::select('carts.*','products.name as pizza_name','products.price as pizza_price','products.image as pizza_image')
    ->leftjoin('products','products.id','carts.pizza_id')
    ->where('user_id',Auth::user()->id)
    ->get();
    $totalprice=0;
    foreach($carts as $cart){
        $totalprice+=$cart->pizza_price*$cart->qty;
    }
    return view('user.cart.Cart',compact('carts','totalprice'));
  }
  public function Contact(){

    return view('user.Contacts.Contact');
  }
  public function insert(Request $request){
     $this->validateAcoount($request);
     $data=$this->getMessageData($request);
     contact::create($data);
     return back()->with(['Success'=>"Your Message is sent Successful"]);
  }
  public function history()
  {
   $order= order::where('user_id',Auth::user()->id)->paginate('3');
       return view('user.main.history',compact('order'));
  }
public function filter($id){
    $pizza=product::where('category_id',$id)->orderBy('created_at','desc')->get();
    $category=Category::get();
    $history=order::where('user_id',Auth::user()->id)->get();
    $cart=cart::where('user_id',Auth::user()->id)->get();
    return view('user.main.user',compact('pizza','category','cart','history'));
}
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
        public function UpdateAcc(Request $request,$id){
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
            return redirect()->route('user#cate')->with(['updateSuccess'=>'Update is successful']);
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
  private function validateAcoount($request){
     Validator::make($request->all(),[
        'name'=>'required',
        'email'=>'required',
        'phone'=>'required',
        'message'=>'required|max:250'
     ])->validate();
  }
  private function getMessageData($request){
   return[
   'name'=>$request->name,
   'email'=>$request->email,
   'phone'=>$request->phone,
    'message'=>$request->message
   ];
  }
      //admin details
           private function CheckPasswordValidation($request){
                Validator::make($request->all(),[
                    'oldPassword'=>'required|min:8',
                    'newPassword'=>'required|min:8',
                    'Confirm'=>'required|min:8|same:newPassword'
                ])->validate();
           }
        }

