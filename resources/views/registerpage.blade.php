@extends('master')
@section('title','Register')
@section('Contents')
<div class="login-form ">
    <form action="{{ route('register') }}" method="post">
        @csrf

        <div class="form-group">

            <label>Username</label>
            <input class="au-input au-input--full @error('name') is-invalid @enderror" type="text" name="name" placeholder="Username">
        </div>
        @error('name')
        <small class="text-danger">{{$message}}</small>
    @enderror
        <div class="form-group">
            <label>Email Address</label>
            <input class="au-input au-input--full" type="email" name="email" placeholder="Email">

        </div>
        @error('email')
        <small class="text-danger">{{$message}}</small>
    @enderror
        <div class="form-group">
            <label>phone number</label>
            <input class="au-input au-input--full" type="text" name="phone" placeholder="phonenumber">

        </div>
        @error('phone')
        <small class="text-danger">{{$message}}</small>
    @enderror
        <div class="form-group">
            <label>Address</label>
            <input class="au-input au-input--full" type="text" name="address" placeholder="Address">

        </div>
        @error('address')
            <small class="text-danger">{{$message}}</small>
        @enderror
        <div class="form-group">
            <label>Password</label>
            <input class="au-input au-input--full" type="password" name="password" placeholder="Password">
                   </div>
                   @error('password')
                   <small class="text-danger">{{$message}}</small>
               @enderror
        <div class="form-group">
            <label>Password</label>
            <input class="au-input au-input--full" type="password" name="confirmation" placeholder="Password">
        </div>
        @error('confirmation')
            <small class="text-danger">{{$message}}</small>
        @enderror
        <div class="login-checkbox">
            <label>
                <input type="checkbox" name="agree">Agree the terms and policy
            </label>
        </div>
        <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">register</button>
    </form>
    <div class="register-link">
        <p>
            Already have account?
            <a href="{{ route('auth#login')}}">Sign In</a>
        </p>
    </div>
</div>
@endsection
