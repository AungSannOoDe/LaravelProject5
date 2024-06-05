@extends('Admin.layouts.app')
@section('Contents')
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <!-- DATA TABLE -->
                        <div class="table-data__tool">
                            <div class="table-data__tool-left">
                                <div class="overview-wrap">
                                    <h2 class="title-1">Admin List</h2>
                                </div>
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
                                <form action="{{route('admin#list')}}" method="get" class="d-flex bg-white  badge badge-pill badge-primary w-75 justify-content-between">
                                    @csrf
                                    <input type="text" name="key" id=""  class="w-75 ml-2" placeholder="Search Category...." value="{{request('key')}}">
                                    <button type="submit" class="btn text-primary"> <i class="fa-solid fa-magnifying-glass"></i></button>
                                </form>
                            </div>
                        </div>
<div class="row my-2 mt-3">
    <div class="col-1 offset-9 bg-white shadow-sm p-2 text-center ">
        <h3 class="text-primary d-flex justify-content-around"> <div class=""><i class="fa-solid fa-database"></i> </div> <div class=""> {{$admin->total()}}</div> </h3>
    </div>

</div>

                            <div class="table-responsive table-responsive-data2">
                                <table class="table table-data2 text-center">
                                    <thead>
                                        <tr>
                                            <th>Image</th>
                                            <th> Admin name</th>
                                            <th>Admin Email</th>
                                            <th>Admin phone</th>
                                            <th>Address</th>
                                            <th>Created_Dated</th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($admin as $a)
                                            <tr class="tr-shadow">
                                                <input type="hidden" name="" value="{{$a->id}}">
                                                <td>
                                                   @if($a->image==null)
                                                   <img src="{{asset('image/user.png')}}" alt="" class="img-tumbnail " style="width:100px; height:100px" >
                                                   @else
                                                   <img src="{{asset('storage/'.$a->image)}}" alt="" class="img-tumbnail " style="width:100px; height:100px">
                                                   @endif
                                                </td>
                                                <td  >{{ $a->name }}</td>
                                                <td >{{ $a->email}}</td>
                                                <td >{{ $a->phone }}</td>
                                                <td >{{ $a->address }}</td>
                                                <td>{{ $a->created_at->format('j-F-Y') }}</td>
                                                <td>
                                                    @if (Auth::user()->id!=$a->id)
                                                    <select name="" id="" class="ChangeUser ">
                                                        <option value="admin" @if($a->role=="admin") selected @endif>admin</option>
                                                        <option value="user" @if ($a->role=="user")
                                                           selected
                                                        @endif>user</option>
                                                        </select>


                                                    @endif
                                                   </td>
                                                <td>
                                                    <div class="table-data-feature d-flex d-flex justify-content-md-around">
                                                        @if (Auth::user()->id ==$a->id)
                                                        <a href="{{ route('admin#details', $a->id) }}">
                                                            <button class="item" data-toggle="tooltip"
                                                            data-placement="top" title="Edit">
                                                            <i class="zmdi zmdi-edit text-warning"></i>
                                                        </button>
                                                    </a>
                                                        @else
                                                        <a href="{{ route('admin#usersProfile', $a->id) }}">
                                                            <button class="item" data-toggle="tooltip"
                                                            data-placement="top" title="Edit">
                                                            <i class="zmdi zmdi-edit text-warning"></i>
                                                        </button>
                                                    </a>
                                                        @endif


                                                        @if (Auth::user()->id ==$a->id)

                                                        @else
                                                        <a href=" {{route('adminacc#delete', $a->id) }}" onclick="">
                                                            <button class="item" data-toggle="tooltip"
                                                                data-placement="top" title="Delete">
                                                                <i class="zmdi zmdi-delete text-danger"></i>
                                                            </button>
                                                        </a>
                                                        @endif

                                                    </div>

                                                </td>
                                            </tr>
                                            <tr class="spacer">
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="mt-3">
                                    {{$admin->links()}}
                                </div>
                            </div>

                        <!-- END DATA TABLE -->
                    </div>
                </div>
            </div>
        </div>
    @endsection
    @section('script')
    <script>
        $(document).ready(function(){
            $('.ChangeUser').change(function(){
               $value=$(this).val();
               $id=$(this).parent().parent().find('input').val();
               $data={
                    'role': $value,
                    'userId':$id
                  };
             $.ajax({
                type:'get',
                  url: 'http://127.0.0.1:8000/admin/user/Role',
                 data:$data,
                  dataType:'json'
             })
             location.reload();
            })
        })




    </script>
    @endsection
