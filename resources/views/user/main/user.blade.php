<?php
use App\Models\product;
?>
@extends('user.layouts.master')
@section('myContents')
 <!-- Shop Start -->
 <div class="container-fluid">
    <div class="row px-xl-5">
        <!-- Shop Sidebar Start -->
        <div class="col-lg-3 col-md-4">
            <!-- Price Start -->
            <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter by price</span></h5>
            <div class="bg-light p-4 mb-30">
                <form>
                    <div class=" d-flex   align-items-center justify-content-between mb-3 bg-dark px-2 py-1">
                        <a href="{{route('user#cate')}}">
                            <label class="  text-white mt-2" for="price-all">All Categories</label>
                            <span class="badge border font-weight-normal text-white">{{ count($category)}}</span>
                        </a>

                    </div>
                    @foreach ( $category as $c)
                    @php
                        $CatCount=App\Models\Product::countCategory($c->id);
                    @endphp
                    <div class=" d-flex custom-control custom-checkbox align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input"  id="color-1">

                        <label class="custom-control-label" for="color-1"><a href="{{route('user#category',$c->id)}}" class="text-dark">{{$c->Cate_name}}</a></label>
                        <span class="badge border font-weight-normal text-dark">{{
$CatCount
                            }}</span>
                    </div>
                    @endforeach

                </form>
            </div>
            <!-- Price End -->



            <!-- Size Start -->


            <!-- Size End -->
        </div>
        <!-- Shop Sidebar End -->


        <!-- Shop Product Start -->
        <div class="col-lg-9 col-md-8">
            <div class="row pb-3">
                <div class="col-12 pb-1">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <div>
                           <button class="btn btn-dark"><a href="{{route('user#Cart')}}" class="text-decoration-none"><i class="fa-solid fa-cart-shopping"></i>({{count($cart)}})</a> </button>
                           <button class="btn btn-dark"><a href="{{route('user#history')}}" class="text-decoration-none"><i class="fa-solid fa-arrows-rotate"></i>({{count($history)}})</a> </button>

                        </div>
                        <div class="ml-2">
                            <select name="sorting" id="sortingOption" class="form-control">
                                <option value="">Choose Option...</option>
                                <option value="asc">Ascending</option>
                                <option value="desc">Descending</option>
                            </select>
                        </div>

                    </div>
                </div>
                <div class="row" id="myList">

                    @if (count($pizza)==0)
                    <h2 class="text-danger shadow-sm  text-center fs-1 col-6 offset-6"> <i class="fa-solid fa-pizza-slice"></i>There is no pizza</h2>
                    @else
                    @foreach ( $pizza as $p )
                    <div class="col-lg-4 col-md-6 col-sm-6 pb-1" id="tr">
                        <input type="hidden" name="" value="{{Auth::user()->id}}" id="userId">
                        <input type="hidden" name="" value="{{$p->id}}" id="productId">
                        <input type="hidden" name="" value="{{$p->image}}" id="imageName">
                        <input type="hidden" name="" value="{{$p->name}}" id="Name">
                        <input type="hidden" name="" value="{{$p->price}}" id="Price">
                        <input type="hidden" name="" value="1" id="qty">
                        <div class="product-item bg-light mb-4" >
                            <div class="product-img position-relative overflow-hidden">
                                <img class="img-fluid w-100" src="{{asset('storage/'.$p->image)}}" alt="" style="height: 250px;">
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" id="DCart"><i class="fa fa-shopping-cart"></i></a>
                                    <a class="btn btn-outline-dark btn-squ " href="{{route('user#product#details',$p->id)}}"><i class="fa-solid fa-circle-info"></i></a>
                                </div>
                            </div>
                            <div class="text-center py-4">
                                <p class="h6 text-decoration-none text-truncate" href="" >{{$p->name}}</p>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5 >{{$p->price}} kyats</h5><h6 class="text-muted ml-2"></h6>
                                </div>
                                <div class="d-flex align-items-center justify-content-center mb-1">
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @endif

                </div>

            </div>
        </div>
        <!-- Shop Product End -->
    </div>
</div>
@endsection
<!-- Shop End -->
@section('script')
<script>
    $(document).ready(function(){
        $('#sortingOption').change(function(){
             sorting=$('#sortingOption').val();
             if(sorting=="asc"){
                $.ajax({
            type:'get',
            url:'http://127.0.0.1:8000/user/ajax/pizzalist',
            data:{'status':'asc'},
            dataType:'json',
            success: function(response){
                $list='';
                for($i=0;$i<response.length;$i++){

                   $list+=`  <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                        <div class="product-item bg-light mb-4" >
                            <div class="product-img position-relative overflow-hidden">
                                <img class="img-fluid w-100" src="{{asset('storage/${response[$i].image}')}}" alt="" style="height: 250px;">
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-sync-alt"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-search"></i></a>
                                </div>
                            </div>
                            <div class="text-center py-4">
                                <a class="h6 text-decoration-none text-truncate" href="">${response[$i].name}</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>${response[$i].price}</h5><h6 class="text-muted ml-2"><del>25000</del></h6>
                                </div>
                                <div class="d-flex align-items-center justify-content-center mb-1">
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                </div>
                            </div>
                        </div>
                    </div>
`;
                }
                $('#myList').html($list);
            }
        })
             }
             else if(sorting=="desc"){
                $.ajax({
            type:'get',
            url:'http://127.0.0.1:8000/user/ajax/pizzalist',
            data:{'status':'desc'},
            dataType:'json',
            success: function(response){
                $list='';
                for($i=0;$i<response.length;$i++){

                   $list+=`  <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                        <div class="product-item bg-light mb-4" >
                            <div class="product-img position-relative overflow-hidden">
                                <img class="img-fluid w-100" src="{{asset('storage/${response[$i].image}')}}" alt="" style="height: 250px;">
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-sync-alt"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-search"></i></a>
                                </div>
                            </div>
                            <div class="text-center py-4">
                                <a class="h6 text-decoration-none text-truncate" href="">${response[$i].name}</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>${response[$i].price}</h5><h6 class="text-muted ml-2"><del>25000</del></h6>
                                </div>
                                <div class="d-flex align-items-center justify-content-center mb-1">
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                </div>
                            </div>
                        </div>
                    </div>
`;
                }
                $('#myList').html($list);
            }
        })
             }
        })
        $('#DCart').click(function(){
            $userId=$('#userId').val();
            $productId=$('#productId').val();
            $imageName=$('#imageName').val();
            $PName=$('#Name').val();
            $Price=$('#Price').val();
            $qty=$('#qty').val();
            $.ajax({
                type:'get',
                url:'http://127.0.0.1:8000/user/ajax/addtoCart',
                data:{
                    'userId':$userId,
                  'pizzaId':$productId,
                  'image':$imageName,
                  'count':$qty
                },
                dataType:'json',
                success:function(response){
    window.location.href="http://127.0.0.1:8000/user/list";
                }

            })
        })
    });
</script>
@endsection
