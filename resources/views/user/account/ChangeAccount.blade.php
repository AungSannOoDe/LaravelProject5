@extends('user.layouts.master')
@section('myContents')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">

            </div>
            <div class="col-lg-6 offset-3">

                <div class="card">
                    <div class="card-body">
                        @if (session('Success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fa-solid fa-check"></i><strong>{{ session('Success') }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                        @endif
                        @if(session('notMatch'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong> <i class="fa-solid fa-triangle-exclamation"></i>{{ session('notMatch') }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                        @endif
                        <div class="card-title">
                            <h3 class="text-center title-2">Change Passwords</h3>
                        </div>
                        <hr>
                        <form action="{{route('user#Change')}}" method="post" novalidate="novalidate">
                            @csrf
                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Old Password</label>
                                <input id="cc-pament" name="oldPassword" type="text" class="form-control
                                @error('oldPassword') is-invalid @enderror   @if(session('notMatch'))
                                is-invalid @endif " aria-required="true" aria-invalid="false" placeholder="Enter Old password...">
                                @error('oldPassword')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror

                            </div>
                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Change Password</label>
                                <input id="cc-pament" name="newPassword" type="text" class="form-control @error('newPassword') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter New Password...">
                                @error('newPassword')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Confirm Password</label>
                                <input id="cc-pament" name="Confirm" type="text" class="form-control @error('Confirm') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Confirm password...">
                                @error('Confirm')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>

                            <div>
                                <button id="payment-button" type="submit" class="btn btn-lg btn-primary btn-block">
                                    <span id="payment-button-amount">Change Password</span>
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
