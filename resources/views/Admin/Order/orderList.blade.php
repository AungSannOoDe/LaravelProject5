@extends('Admin.layouts.app')
@section('Contents')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                    @if(count($orderlist)!=0)
                    <div class="table-responsive table-responsive-data2">
                        <a href="{{route('order#list')}}">back</a>
                        <div class="row col-5">
                            <div class="card">
                                <div class="card-body">
                                    <h3><i class="fa-solid fa-clipboard me-3"></i>Order Info  <span>Include Delivery</span> </h3>
                                </div>
                                <div class="card-body">
                                    <div class="row mb-3">
                                        <div class="col">User Name</div>
                                        <div class="col">{{strtoupper($orderlist[0]->user_name)}}</div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col">Order Code</div>
                                        <div class="col">{{strtoupper($orderlist[0]->order_code)}}</div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col">Order Date</div>
                                        <div class="col">{{strtoupper($orderlist[0]->created_at->format('F-j-Y'))}}</div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col">Total</div>
                                        <div class="col">{{strtoupper($order->total_price)}} kyats</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <table class="table table-data2 text-center">
                            <thead>
                                <tr>
                                    <th>User Id</th>
                                    <th>product Image</th>
                                    <th>product Name</th>
                                    <th>qty</th>
                                    <th>Total Price</th>
                                </tr>
                            </thead>
                            <tbody id="dataList">
                                @foreach ($orderlist as $o)
                                    <tr class="shadow">
                                        <td class="text-center"> <p class="mt-4" >{{ $o->user_id }}</p></td>
                                        <td><img src="{{ asset('storage/'.$o->product_image) }}" alt="" class="img-tumbnails" width="50px" ></td>
                                        <td>{{$o->product_name}}</td>
                                        <td> {{$o->qty}}</td>
                                        <td>{{ $o->total}}</td>
                                    </tr>
                                    <tr class="spacer">
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <h1 class="text-danger text-center">This is no product </h1>
                        <!-- END DATA TABLE -->
                        @endif
                    </div>
                </div>
            </div>
        </div>
@endsection
