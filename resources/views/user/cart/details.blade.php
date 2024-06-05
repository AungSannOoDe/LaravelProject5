@extends('user.layouts.master')
@section('myContents')
    <div class="container-fluid pb-5">
        <div class="row px-xl-5">

            <div class="col-lg-5 mb-30">
                <a href="{{ route('user#cate') }} " class="text-darktext-decoration-none ">back</a>
                <div id="product-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner bg-light">

                        <img class="w-100 h-100" src="{{ asset('storage/' . $pizza->image) }}" alt="Image">
                    </div>
                    <a class="carousel-control-prev" href="#product-carousel" data-slide="prev">
                        <i class="fa fa-2x fa-angle-left text-dark"></i>
                    </a>
                    <a class="carousel-control-next" href="#product-carousel" data-slide="next">
                        <i class="fa fa-2x fa-angle-right text-dark"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-7 h-auto mb-30">
                <div class="h-100 bg-light p-30">
                    <input type="hidden" name="" value="{{Auth::user()->id}}" id="userId">
                    <input type="hidden" name="" value="{{$pizza->id}}" id="pizzaId">
                    <h3>{{ $pizza->name }}</h3>
                    <div class="d-flex mb-3">
                        <div class="text-primary mr-2">
                            <small class="fas fa-star"></small>
                            <small class="fas fa-star"></small>
                            <small class="fas fa-star"></small>
                            <small class="fas fa-star-half-alt"></small>
                            <small class="far fa-star"></small>
                        </div>
                        <small class="pt-1">({{ $pizza->view_count }} Reviews)</small>
                    </div>
                    <h3 class="font-weight-semi-bold mb-4">{{ $pizza->price }} kyats</h3>
                     <h4><i class="fa-regular fa-clock"></i>{{$pizza->waiting_time}} mins</h4>
                    <p class="mb-4">{{ $pizza->description }}</p>
                    <div class="d-flex align-items-center mb-4 pt-2">
                        <div class="center">
                            <div class="input-group quantity mx-auto" style="width: 100px;">
                                <div class="input-group-btn">
                                    <button class="btn btn-sm btn-primary btn-minus" >
                                    <i class="fa fa-minus text-white"></i>
                                    </button>
                                </div>
                                <input type="text" class="form-control form-control-sm bg-secondary border-0 text-center"  id="orderBtn" value="1">
                                <div class="input-group-btn">
                                    <button class="btn btn-sm btn-primary btn-plus">
                                        <i class="fa fa-plus text-white"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary px-3 ml-4" type="button" id="addtoCart"><i class="fa fa-shopping-cart mr-1"></i> Add To
                            Cart</button>
                    </div>

                    <div class="d-flex pt-2">
                        <strong class="text-dark mr-2">Share on:</strong>
                        <div class="d-inline-flex">
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-pinterest"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Products Start -->
        <div class="container-fluid py-5">
            <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">You May
                    Also Like</span></h2>
            <div class="row px-xl-5">
                <div class="col">
                    <div class="owl-carousel related-carousel">
                        @foreach ($pizzalist as $p)
                            <div class="product-item bg-light">
                                <input type="hidden" name="" value="{{$p->id}}" id="productId">
                                <div class="product-img position-relative overflow-hidden">
                                    <img class="img-fluid w-100" src="{{ asset('storage/' . $p->image) }}" alt="">
                                    <div class="product-action">
                                        <a class="btn btn-outline-dark btn-square" href=""><i
                                                class="fa fa-shopping-cart"></i></a>
                                        <a class="btn btn-outline-dark btn-square" href=""><i
                                                class="far fa-heart"></i></a>
                                        <a class="btn btn-outline-dark btn-square" href=""><i
                                                class="fa fa-sync-alt"></i></a>
                                        <a class="btn btn-outline-dark btn-square" href=""><i
                                                class="fa fa-search"></i></a>
                                    </div>
                                </div>
                                <div class="text-center py-4">
                                    <a class="h6 text-decoration-none text-truncate" href="">{{ $p->name }}</a>
                                    <div class="d-flex align-items-center justify-content-center mt-2">
                                        <h5>{{ $p->price }}</h5>
                                <h1>Hello</h1>
                                        <h6 class="text-muted ml-2"><del>{{ $p->price }}</del></h6>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-center mb-1">
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small>{{ $p->view_count +1 }}</small>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')

<script>
    $(document).ready(function(){
      $('.btn-minus').click(function(){
        $order= Number($('#orderBtn').val())-1;
  $('#orderBtn').val($order);

      })
      $('.btn-plus').click(function(){
        $order= Number($('#orderBtn').val())+1;
  $('#orderBtn').val($order);
      })

        $.ajax({
            type:'get',
               url:'http://127.0.0.1:8000/user/ajax/increase/view',
               data:{'productId':$('#productId').val()},
            dataType:'json',
        })
        $('#addtoCart').click(function(){
            $count= $('#orderBtn').val();
            $pizzaId=$('#pizzaId').val();
            $userId=$('#userId').val();
            $source= {
        'userId':$userId,
        'pizzaId':$pizzaId,
        'count':$count
            };
           $.ajax({
              type:'get',
               url:'http://127.0.0.1:8000/user/ajax/addtoCart',
               data:$source,
            dataType:'json',
            success:function(response){
                 if(response.status == 'success'){
   window.location.href="http://127.0.0.1:8000/user/list";
                 }
            }
           })
        })

    })
    </script>
@endsection

