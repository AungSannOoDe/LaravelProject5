@extends('Admin.layouts.app')
@section('Contents')
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">

                    <div class="col-md-12">
                        <!-- DATA TABLE -->
                        <div class="table-data__tool">
                            <div class="table-data__tool-left">
                                <div class="overview-wrap">
                                    <h2 class="title-1">Pizza List</h2>

                                </div>
                            </div>
                            <div class="table-data__tool-right">
                                <a href="{{ route('product#createPage') }}">
                                    <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                        <i class=" fa fa-plus"></i>add product
                                    </button>
                                </a>
                                <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                    CSV download
                                </button>
                            </div>

                        </div>
                        @if (session('createSuccess'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong><i class="fa-solid fa-pen"></i></strong> {{ session('createSuccess') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        @if (session('updateSuccess'))
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong><i class="fa-solid fa-file-pen"></i></strong> {{ session('updateSuccess') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        @if (session('deleteSuccess'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong><i class="fa-solid fa-trash"></i></strong>{{ session('deleteSuccess') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        <div class="row">

                            <div class="col-3">
                                <h3 class="text-secondary">Search Key: <span class="text-danger">{{ request('key') }}
                                    </span></h3>
                            </div>
                            <div class="col-4 offset-5 ">
                                <form action="{{ route('product#list') }}" method="get"
                                    class="d-flex bg-white  badge badge-pill badge-primary w-75 justify-content-between">
                                    @csrf
                                    <input type="text" name="key" id="" class="w-75 ml-2"
                                        placeholder="Search Category...." value="{{ request('key') }}">
                                    <button type="submit" class="btn text-primary"> <i
                                            class="fa-solid fa-magnifying-glass"></i></button>
                                </form>
                            </div>
                        </div>
                        <div class="row my-2 mt-3">
                            <div class="col-1 offset-9 bg-white shadow-sm p-2 text-center ">
                                <h3 class="text-primary d-flex justify-content-around">
                                    <div class=""><i class="fa-solid fa-database"></i> {{$pizza->total()}} </div>

                                </h3>
                            </div>
                        </div>
                        @if(count($pizza)!=0)
                        <div class="table-responsive table-responsive-data2">
                            <table class="table table-data2 text-center">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th> product name</th>
                                        <th>price</th>
                                        <th>Category</th>
                                        <th>Description</th>
                                        <th>Waiting_time</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pizza as $p)
                                        <tr class="shadow">
                                            <td><img src="{{ asset('storage/' . $p->image) }}" alt=""
                                                    class="img-tumbnail " style="width:100px; height:100px;"></td>
                                            <td>{{ $p->name }}</td>
                                            <td>{{ $p->price }}</td>
                                            <td>{{$p->Cat_name}}</td>
                                            <td>{{ $p->description }}</td>
                                            <td>{{ $p->waiting_time }}</td>
                                            <td>
                                                <h3>


                                                <a href="{{route('product#details',$p->id)}}">
                                                    <button class="item" data-toggle="tooltip" data-placement="top"
                                                    title="Send">
                                                    <i class="zmdi zmdi-mail-send text-primary"></i>
                                                </button>
                                                </a>

                                                    <a href="{{route('product#edit',$p->id)}}">
                                                        <button class="item" data-toggle="tooltip" data-placement="top"
                                                            title="Edit">
                                                            <i class="zmdi zmdi-edit text-warning"></i>
                                                        </button>
                                                    </a>
                                                    <a href="{{route('product#delete',$p->id)}}" onclick="">
                                                        <button class="item" data-toggle="tooltip" data-placement="top"
                                                            title="Delete">
                                                            <i class="zmdi zmdi-delete text-danger"></i>
                                                        </button>
                                                    </a>


                                                </h3>

                                            </td>
                                        </tr>
                                        <tr class="spacer">
                                        </tr>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                            <div class="mt-3">
                               {{$pizza->links()  }}
                            </div>

                        @else
                            <h1 class="text-danger text-center">This is no product </h1>

                            <!-- END DATA TABLE -->
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endsection
