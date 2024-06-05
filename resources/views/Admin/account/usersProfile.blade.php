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
                            @foreach ( $users as  $u)
                            <div class="row">
                                <div class="col-3 offset-3 mt-4">
                                   @if ($u->image==null)
                                       <img src="{{asset('image/user.png')}}" alt="" class="img-tumbnail">
                                       @else
                                       <img src="{{asset('storage/'.$u->image)}}" alt="">

                                   @endif
                                </div>
                                <div class="col-5 offset-1">
                                     <h4  class="my-4">Name::{{$u->name}}</h4>
                                     <h4 class="my-4">Email::{{$u->email}}</h4>
                                     <h4 class="my-4">Phone::{{$u->phone}}</h2>
                                     <h4 class="my-4">Address::{{$u->address}}</h4>
                                     <h4 class="my-4"> joinDate::{{$u->created_at->format('j-F-Y')}}</h4>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-4 offset-5">
                                    <a href="{{route('admin#userupdate',$u->id)}}">
                                        <button class="btn btn-dark text-white">Edit profile</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                            @endforeach

                    </div>
                </div>
            </div>
        </div>
    @endsection
