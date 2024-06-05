@extends('Admin.layouts.app')
@section('Contents')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
            </div>
            <div class="row">
                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2 text-center">
                            <thead>
                                <tr>
                                    <th>User Name</th>
                                    <th>User Image</th>
                                    <th>Email</th>
                                    <th>Phone  number</th>
                                    <th>Address</th>
                                    <th>Role</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                <tr class="tr-shadow">
                                    <input type="hidden" name="" value="{{$user->id}}">
                                    <td>{{$user->name}}</td>
                                    <td>
                                        @if ($user->image==null)
                                               <img src="{{asset('image/user.png')}}" alt="" width="50px" height="50px">
                                        @else
                                        <img src="{{asset('storage/'.$user->image)}}" alt="" width="50px" height="50px">
                                        @endif
                                    </td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->phone}}</td>
                                    <td>{{$user->address}}</td>
                                    <td> <select name="" id="" class="form-control ChangeUser">
                                    <option value="admin" @if ($user->role=="admin")selected
                                    @endif>admin</option>
                                    <option value="user" @if ($user->role=="user") selected @endif>User</option>
                                    </select> </td>
                                   <td>  <a href="{{route('adminacc#delete', $user->id) }}"><i class="fa-solid fa-trash"></i> </a></td>
                                </tr>

                                <tr class="spacer"></tr>
                            </tbody>
                                @endforeach

                        </table>
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
