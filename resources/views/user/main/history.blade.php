@extends('user.layouts.master')
@section('myContents')
<div class="container-fluid" style="height: 400px;">
<div class="row px-xl-5">
    <div class="col-lg-8 offset-2 table-responsive mb-5">
        <table class="table table-light table-borderless table-hover text-center mb-0" id="dataTable">
            <thead class="thead-dark">
                <tr>
                    <th>Date</th>
                   <th>Order ID</th>
                   <th>Total price</th>
                   <th>Status</th>

                </tr>
        <tbody class="align-middle">
      @foreach ( $order as  $or)
      <tr>
        <td class="align-middle">{{$or->created_at->format('F-j-Y')}}</td>
        <td class="align-middle">{{$or->order_code}}</td>
        <td class="align-middle">{{$or->total_price}}</td>
        <td class="align-middle">
            @if ($or->status==0)
                <button class="btn btn-sm btn-warning shadow-sm">Pending....</button>
            @elseif($or->status==1)
            <button class="btn btn-sm btn-success shadow-sm">Success...</button>
            @elseif($or->status==2)
            <button class="btn btn-sm btn-danger shadow-sm">Reject....</button>
            @endif

        </td>
      </tr>

      @endforeach
        </tbody>
            </thead>
        </table>
        <div class="mt-3">
            {{$order->links()}}
        </div>
    </div>

</div>
</div>
@endsection
