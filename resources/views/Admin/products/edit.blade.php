@extends('Admin.layouts.app')
@section('title', 'Create Page')
@section('Contents')
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">

                </div>
                <div class="col-lg-10 offset-1">

                    <div class="card">
                        <div class="card-body">
                            <div class="ms-2">
                                <p onclick="history.back()">back</p>
                            </div>
                            <div class="card-title">
                                <h3 class="text-center title-2">Account Informations</h3>
                            </div>
                            <hr>
                            <form action="{{route('product#update')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <input type="hidden" name="pizzaId" value="{{$pizza->id}}">
                                    <div class="col-4 offset-2 mt-5">
                                              <img src="{{asset('storage/'. $pizza->image)}}" alt="" class="img-thumbnail shadow-sm ">
                                        <input type="file" name="pizzaImage" id="" class="form-control  mt-2   @error('pizzaImage') is-invalid @enderror ">
                                        @error('pizzaImage')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            <button class="btn btn-dark text-white mt-4 w-100" type="submit">update product</button>
                                    </div>
                                    <div class="col-6 ">
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Name</label>
                                            <input id="cc-pament" name="pizzaName" type="text"
                                                class="form-control
                                            @error('pizzaName') is-invalid @enderror"
                                                aria-required="true" aria-invalid="false"
                                                placeholder="Enter name..." value="{{old('pizzaName',$pizza->name)}}">
                                            @error('pizzaName')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">price</label>
                                            <input id="cc-pament" name="pizzaPrice" type="number"
                                                class="form-control
                                            @error('pizzaPrice') is-invalid @enderror"
                                                aria-required="true" aria-invalid="false" placeholder="Enter price..." value="{{old('pizzaPrice',$pizza->price)}}">
                                            @error('pizzaPrice')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Category</label>
                                            <select name="pizzaCategory" id="" class="form-control">
  <option value="">Chose Category</option>
  @foreach ( $category as  $c)
      <option value="{{$c->id}}" @if($c->id == $pizza->category_id)  selected @endif>{{$c->Cate_name}}</option>
  @endforeach
                                            </select>

                                            @error('pizzaCategory')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Description</label>
                                           <textarea name="pizzaDescription" id="" cols="30" rows="10" class="form-control">
                                            {{old('pizzaDescription',$pizza->description)}}
                                           </textarea>
                                            @error('pizzaDescription')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Waiting_time</label>
                                            <input id="cc-pament" name="pizzaWaiting" type="number"
                                                class="form-control
                                            @error('pizzaWaiting') is-invalid @enderror"
                                                aria-required="true" aria-invalid="false"
                                                placeholder="Enter Role..." value="{{old('Waiting',$pizza->waiting_time)}}">
                                            @error('pizzaWaiting')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Count</label>
                                            <input id="cc-pament" name="Count" type="number"
                                                class="form-control" disabled
                                                aria-required="true" aria-invalid="false"
                                                placeholder="Enter Role..." value="{{old('Count',$pizza->view_count)}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Creating_time</label>
                                            <input id="cc-pament" name="created" type="text"
                                                class="form-control
                                           "
                                                aria-required="true" aria-invalid="false"
                                                placeholder="Enter Role..." value="{{old('created',$pizza->created_at)}}" disabled>
                                        </div>

                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
