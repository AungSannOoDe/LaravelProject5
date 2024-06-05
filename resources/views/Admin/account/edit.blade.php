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
                            <div class="card-title">
                                <h3 class="text-center title-2">Account Informations</h3>
                            </div>
                            <hr>
                            <form action="{{route('Adminprofile#update',Auth::user()->id)}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-4 offset-2 mt-5">
                                        @if (Auth::user()->image==null)
                                            <img src="{{asset('image/user.png')}}" alt="" class="img-tumbnail shadow-sm">
                                        @else
                                            <img src="{{asset('storage/'.Auth::user()->image)}}" alt="">
                                        @endif
                                        <input type="file" name="image" id="" class="form-control  mt-2   @error('image') is-invalid @enderror ">
                                        @error('image')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            <button class="btn btn-dark text-white mt-4 w-100" type="submit">update profile</button>
                                    </div>
                                    <div class="col-4 ">
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Name</label>
                                            <input id="cc-pament" name="name" type="text"
                                                class="form-control
                                            @error('name') is-invalid @enderror"
                                                aria-required="true" aria-invalid="false"
                                                placeholder="Enter Old password..." value="{{old('name',Auth::user()->name)}}">
                                            @error('name')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Email</label>
                                            <input id="cc-pament" name="email" type="email"
                                                class="form-control
                                            @error('email') is-invalid @enderror"
                                                aria-required="true" aria-invalid="false" placeholder="Enter Email..." value="{{old('email',Auth::user()->email)}}">
                                            @error('email')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Phone</label>
                                            <input id="cc-pament" name="phone" type="text"
                                                class="form-control
                                            @error('phone') is-invalid @enderror"
                                                aria-required="true" aria-invalid="false"
                                                placeholder="Enter phone number..." value="{{old('phone',Auth::user()->phone)}}">
                                            @error('phone')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Address</label>
                                           <textarea name="address" id="" cols="30" rows="10" class="form-control">
                                            {{old('address',Auth::user()->address)}}
                                           </textarea>
                                            @error('address')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Role</label>
                                            <input id="cc-pament" name="role" type="text"
                                                class="form-control
                                            @error('role') is-invalid @enderror"
                                                aria-required="true" aria-invalid="false"
                                                placeholder="Enter Role..." disabled value="{{old('role',Auth::user()->role)}}">
                                            @error('role')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
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
