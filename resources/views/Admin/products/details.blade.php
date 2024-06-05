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
                                <h3 class="text-center title-2 me-2">pizza-Details</h3>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-3 offset-2 mt-4">

                                    <img src="{{ asset('storage/' . $p->image) }}" alt="" class="img-tumbnail shadow-sm">


                                </div>
                                <div class="col-7 ">

                                    <h3 class=" d-block  btn bg-danger text-white w-25 fs-5">{{ $p->name }}</h3>
                                    <span class=" btn bg-dark text-white ">{{ $p->price }} kyats</span>
                                    <span class="my-4 btn bg-dark text-white">{{ $p->waiting_time }}</span>

                                    <span class=" btn bg-dark text-white ">{{ $p->view_count }}</span>
                                    <span class=" btn bg-dark text-white ">{{ $p->Cat_name }}</span>
                                    <span class="btn bg-dark text-white"> {{ $p->created_at->format('j-F-Y') }}</span>

                                    <div class="my-3">
                                        <div class="">Details::</div>
                                        <div class=""> {{ $p->description }}</div>
                                    </div>
                                </div>

                            </div>
                            <div class="row mt-2">
                                <div class="col-4 offset-5">
                                    <a href="{{ route('admin#editProfile') }}">
                                        <button class="btn btn-dark text-white">Edit profile</button>
                                    </a>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
