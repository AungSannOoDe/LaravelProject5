@extends('Admin.layouts.app')
@section('title', 'Create Page')
@section('Contents')
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-3 offset-8">
                        <a href="{{ route('product#list') }}"><button class="btn bg-dark text-white my-3">List</button></a>
                    </div>
                </div>
                <div class="col-lg-6 offset-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2">Add products form</h3>
                            </div>
                            <hr>
                            <form action="{{route('product#create')}}" method="post" novalidate="novalidate" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">Name</label>
                                    <input id="cc-pament" name="pizzaName" type="text" class="form-control @error('pizzaName') is-invalid
                                    @enderror " value="{{old('pizzaName')}}"aria-required="true" aria-invalid="false" placeholder="Enter pizza name...">
                                    @error('pizzaName')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">image</label>
                                    <input id="cc-pament" name="pizzaWaiting" type="number" class="form-control  @error('pizzaWaiting')
                                        is-invalid
                                    @enderror" value="{{old('pizzaImage')}}"aria-required="true" aria-invalid="false" placeholder="Image...">
                                    @error('pizzaWaiting')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @enderror
                                </div>
                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">image</label>
                                    <input id="cc-pament" name="pizzaImage" type="file" class="form-control  @error('pizzaImage')
                                        is-invalid
                                    @enderror" value="{{old('pizzaImage')}}"aria-required="true" aria-invalid="false" placeholder="Image...">
                                    @error('pizzaImage')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @enderror
                                </div>
                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">Category</label>
                                <select name="pizzaCategory" id="" class="form-control @error('pizzaCategory')
                                    is-invalid
                                @enderror" vlaue='{{old('pizzaCategory')}}'>
                                    <option value="">Choose your category</option>
                                    @foreach ($categories as $c )
                                        <option value="{{$c->id}}">{{$c->Cate_name}}</option>
                                    @endforeach
                                </select>
                                @error('pizzaCategory')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                                </div>

                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">descrption</label>
                                   <textarea name="pizzaDescription" id="" cols="30" rows="10" class="form-control @error('pizzaDescription') is-invalid
                                   @enderror" vlaue="{{old('pizzaDescription')}}">


                                   </textarea>
                                   @error('pizzaDescription')
                                   <div class="invalid-feedback">
                                       {{$message}}
                                   </div>
                               @enderror
                                </div>

                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">price</label>
                                    <input id="cc-pament" name="pizzaPrice" type="number" class="form-control   @error('pizzaPrice')
                                      is-invalid
                                    @enderror " value="{{old('pizzaPrice')}}" aria-required="true" aria-invalid="false" placeholder="Enter pizza Price..." >
                                    @error('pizzaPrice')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @enderror
                                </div>

                                <div>
                                    <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                        <span id="payment-button-amount">Create</span>
                                        <span id="payment-button-sending" style="display:none;">Sending…</span>
                                        <i class="fa-solid fa-circle-right"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
