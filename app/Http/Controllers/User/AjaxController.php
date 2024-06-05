<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\cart;
use App\Models\order;
use App\Models\product;
use App\Models\orderlist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{
    public function pizzalist(Request $request){
        logger($request);
        if($request->status=="asc"){
            $data=product::orderBy('created_at','asc')->get();
        }
         else if($request->status=="desc"){
            $data=product::orderBy('created_at','desc')->get();
         }
        return $data;
    }
    public function removeCart(Request $request){
        Cart::where('user_id',Auth::user()->id)->where('pizza_id',$request->productId)->where('id',$request->orderId)->delete();
    }
    public function OrderList(Request $request){
        $total=0;
        foreach($request->all() as $item){
           $data= orderlist::create([
                'user_id'=>$item['user_id'],
                'product_id'=>$item['pizza_id'],
                'total'=>$item['total'],
                'qty'=>$item['qty'],
                'order_code'=>$item['order_code']
            ]);
     $total+=$data->total+3000;
        }
        order::create([
         'user_id'=>Auth::user()->id,
         'order_code'=>$data->order_code,
         'total_price'=>$total
        ]);
        Cart::where('user_id',Auth::user()->id)->delete();
   $response=[
    'status'=>'true'
   ];
   return response()->json($response,200);
    }
    public function addtoCart(Request $request){
        $data=$this->getOrderData($request);
       cart::create($data);
       $response=[
        'message'=>'Add to Cart Successfully',
        'status'=>'success'
       ];
       return response()->json($response,200);

    }
    public function ClearCart(){
 Cart::where('user_id',Auth::user()->id)->delete();
    }
    public function statusUpdate(Request $request){
        $data=$this->getStatusOrder($request);
        $orderlist= order::where('id',$request->orderId)->update($data);
        return response()->json($orderlist,200);
    }
    public function increaseView(Request $request){
      $data=product::where('id',$request->productId)->first();
      $viewCount=[
      'view_count' =>  $data->view_count+1
      ];
      product::where('id',$request->productId)->update($viewCount);
    }
    public function status(Request $request){
        $order=order::select('orders.*','users.name as user_name')
        ->leftjoin('users','users.id','orders.user_id')
        ->orderBy('created_at','desc')
     ;
      if($request->status==null){
         $order=$order->get();
      }
      else{
          $order=$order->where('orders.status',$request->status)->get();
      }
      return response()->json($order,200);
    }
    private function getOrderData($request){
        return [
          'user_id'=>$request->userId,
          'pizza_id'=>$request->pizzaId,
          'image'=>$request->image,
          'qty'=>$request->count,
          'created_at'=>Carbon::now()
        ];
    }
    private function getStatusOrder($request){
       return[
        'status'=>$request->statusUpdate
       ];
    }
}
