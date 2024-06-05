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
                                    <h2 class="title-1">Category List</h2>

                                </div>
                            </div>
                            <div class="table-data__tool-right">
                                <a href="{{ route('admin#createPage') }}">
                                    <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                        <i class=" fa fa-plus"></i>add Category
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
                                <h3 class="text-secondary">Search Key: <span class="text-danger">{{request('key')}} </span></h3>
                            </div>
                            <div class="col-4 offset-5 ">
                                <form action="{{route('admin#cate')}}" method="get" class="d-flex bg-white  badge badge-pill badge-primary w-75 justify-content-between">
                                    @csrf
                                    <input type="text" name="key" id=""  class="w-75 ml-2" placeholder="Search Category...." value="{{request('key')}}">
                                    <button type="submit" class="btn text-primary"> <i class="fa-solid fa-magnifying-glass"></i></button>
                                </form>
                            </div>
                        </div>
<div class="row my-2 mt-3">
    <div class="col-1 offset-9 bg-white shadow-sm p-2 text-center ">
        <h3 class="text-primary d-flex justify-content-around"> <div class=""><i class="fa-solid fa-database"></i> </div> <div class=""> {{$categories->total()}}</div> </h3>
    </div>

</div>
                        @if (count($categories) != 0)
                            <div class="table-responsive table-responsive-data2">
                                <table class="table table-data2 text-center">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th> Category name</th>
                                            <th>Created_Dated</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($categories as $category)
                                            <tr class="tr-shadow">
                                                <td>
                                                    {{ $category->id }}
                                                </td>
                                                <td class="col-6">{{ $category->Cate_name }}</td>

                                                <td>{{ $category->created_at->format('j-F-Y') }}</td>
                                                <td>
                                                    <div class="table-data-feature d-flex d-flex justify-content-md-around">
                                                        <button class="item" data-toggle="tooltip" data-placement="top"
                                                            title="Send">
                                                            <i class="zmdi zmdi-mail-send text-primary"></i>
                                                        </button>
                                                        <a href="{{ route('admin#edit', $category->id) }}">
                                                            <button class="item" data-toggle="tooltip"
                                                                data-placement="top" title="Edit">
                                                                <i class="zmdi zmdi-edit text-warning"></i>
                                                            </button>
                                                        </a>
                                                        <a href="{{ route('admin#delete', $category->id) }}" onclick="">
                                                            <button class="item" data-toggle="tooltip"
                                                                data-placement="top" title="Delete">
                                                                <i class="zmdi zmdi-delete text-danger"></i>
                                                            </button>
                                                        </a>


                                                    </div>

                                                </td>
                                            </tr>
                                            <tr class="spacer">
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="mt-3">
                                    {{$categories->links()}}
                                </div>
                            </div>
                        @else
                            <h1 class="text-secondary text-center">There is no Categories</h1>
                        @endif

                        <!-- END DATA TABLE -->
                    </div>
                </div>
            </div>
        </div>
    @endsection
