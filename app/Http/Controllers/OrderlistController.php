<?php

namespace App\Http\Controllers;

use App\Models\order;
use App\Models\orderlist;
use Illuminate\Http\Request;

class OrderlistController extends Controller
{
    public function orderlist($orderCode){
        $order=order::where('order_code',$orderCode)->first();
      $orderlist=orderlist::select('orderlists.*','users.name as user_name','products.name as product_name',
      'products.image as product_image')
      ->leftjoin('users','users.id','orderlists.user_id')->
      leftjoin('products','products.id','orderlists.product_id')->
      where('order_code',$orderCode)->get();
    return view('Admin.Order.orderList',compact('orderlist','order'));
    }
}
