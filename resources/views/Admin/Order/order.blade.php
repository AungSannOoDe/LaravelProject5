@extends('Admin.layouts.app')
@section('Contents')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <!-- DATA TABLE -->

                    <div class="row">

                        <div class="col-3">
<select name="status" id="status" class="form-control">
    <option value="">All</option>
    <option value="0">Pending</option>
    <option value="1">accept</option>
    <option value="2">Reject</option>
</select>
                        </div>
                        <div class="col-1 offset-8 bg-white shadow-sm p-2 text-center ">
                            <h3 class="text-primary d-flex justify-content-around"> <div class=""><i class="fa-solid fa-database"></i> </div> <div class=""> {{count($order)}}</div> </h3>
                        </div>
                    </div>
                    </div>
                    @if(count($order)!=0)
                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2 text-center">
                            <thead>
                                <tr>
                                    <th>Order Id</th>
                                    <th>User Name</th>
                                    <th> Order Code</th>
                                    <th>Date</th>
                                    <th>Total Price</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody id="dataList">

                                @foreach ($order as $o)

                                    <tr class="shadow">
                                     <input type="hidden" value="{{ $o->id }}" id="orderId">
                                        <td>{{ $o->id }}</td>
                                        <td>{{ $o->user_name }}</td>
                                        <td> <a href="{{route('admin#order',$o->order_code)}}" class="text-danger"> {{ $o->order_code }}</a> </td>
                                        <td>{{$o->created_at->format('F-j-Y')}}</td>
                                        <td>{{ $o->total_price }}</td>
                                        <td>
                                            <select name="status" id="updatestatus" class="form-control" >
                                                <option value="0" @if ($o->status==0)
                                                   selected
                                                @endif>Pending</option>
                                                <option value="1" @if ($o->status==1)
                                                    selected
                                                 @endif>Accept</option>
                                                 <option value="2" @if ($o->status==2)
                                                    selected
                                                 @endif>Reject</option>

                                            </select>
                                        </td>
                                        <td>
                                        </td>
                                    </tr>
                                    <tr class="spacer">
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    @else
                        <h1 class="text-danger text-center">This is no product </h1>

                        <!-- END DATA TABLE -->
                        @endif
                    </div>
                </div>
            </div>
        </div>
@endsection
@section('script')
<script>
    $(document).ready(function(){
        $('#status').change(function(){
        $status= $('#status').val();
    $.ajax({
        type:'get',
       url: 'http://127.0.0.1:8000/admin/status',
       data:{
        'status':$status,
       },
       dataType:'json',
       success:function(response){
        console.log(response);
     $list='';


        for($i=0;$i<response.length;$i++){
           $month=['January','Feburay','March','April','May','June','July','August','Septmeber','October','November','December'];
        date=new Date(response[$i].created_at);
         $dDate=$month[date.getMonth()]+"-"+date.getDate()+"-"+date.getFullYear();
     if(response[$i].status==0){
        $message=`<select name="status" id="" class="form-control">
                                                <option value="0"
                                                   selected
                                                >Pending</option>
                                                <option value="1">Accept</option>
                                                 <option value="2">Reject</option>

                                            </select>`;
     }
     if(response[$i].status==1){
        $message=`<select name="status" id="" class="form-control">
                                                <option value="0"

                                                >Pending</option>
                                                <option value="1" selected>Accept</option>
                                                 <option value="2">Reject</option>

                                            </select>`;
     }
     if(response[$i].status==2){
        $message=`<select name="status" id="" class="form-control">
                                                <option value="0"

                                                >Pending</option>
                                                <option value="1" >Accept</option>
                                                 <option value="2" selected >Reject</option>

                                            </select>`;
     }


        $list+=`
        <tr class="shadow">
                                        <td>${response[$i].user_id}</td>
                                        <td> ${response[$i].user_name} </td>
                                        <td> ${response[$i].order_code}</td>
                                        <td>${$dDate}</td>
                                        <td> ${response[$i].total_price}</td>

                                        <td>
    ${$message}
                                        </td>
                                        <td>
                                        </td>
                                    </tr>
                                    <tr class="spacer">
                                    </tr>

        `;
     }
     $('#dataList').html($list);
     }
    })
    })
    $('#updatestatus').change(function(){
      $statusUpdate= $(this).val();
      parentNode=$(this).parents('tr');
      $orderId=parentNode.find('#orderId').val();
      $data={
                'statusUpdate':$statusUpdate,
                'orderId':$orderId
              };
         $.ajax({
            type:'get',
              url: 'http://127.0.0.1:8000/admin/status/update',
             data:$data,
              dataType:'json',
         })
         location.reload();
    })
    })


</script>
@endsection
