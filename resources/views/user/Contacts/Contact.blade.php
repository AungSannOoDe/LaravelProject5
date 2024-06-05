@extends('user.layouts.master')
@section('style')
<style>
.hello{
  overflow: hidden;
}
  </style>
@endsection
@section('myContents')
<div class="container-fluid hello">
    @if(session('Success'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong><i class="fa-solid fa-check"></i></strong> {{session('Success')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      @endif
    <div class="row">
        <div class="col-6 ">
        <img src="{{asset('image/Contact.jpg')}}" alt="" class="w-100 h-75 ms-3">
        </div>
        <div class="col-5  mt-2 ">
            <h2 class="text-center">Contact Us </h2>
      <form action="{{route('Contact#insert')}}" class="mt-5 p-2 ms-4 bg-secondary" method="post">
        @csrf
          <div class="row mt-2">
            <label for="">Name</label>
            <input type="text" class="form-control @error('name')
            is-invalid @enderror  w-75" placeholder="Enter your name...." value="{{Auth::user()->name}}" name="name" >
            @error('name')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
          </div>
          <div class="row mt-4">
            <label for="">Email</label>
            <input type="email" class="form-control @error('email')  is-invalid @enderror" placeholder="Enter your email...." value="{{Auth::user()->email}}"name="email" class=" ">
            @error('email')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>
          <div class="row mt-4">
            <label for="">phone Number</label>
            <input type="text" class="form-control @error('phone')  is-invalid @enderror" placeholder="Enter your phone...." value="{{Auth::user()->phone}}" name="phone" class="">
            @error('phone')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
          </div>
          <div class="row mt-4">
            <label for="">Message</label>
           <textarea name="message" id="" cols="30" rows="10" class="form-control message-container @error('message')  is-invalid @enderror" class="" placeholder="Enter message....">
           </textarea>
           <div id="title" class="text-danger">OOps.....Your text is limited</div>
           @error('message')
           <div class="invalid-feedback">
               {{$message}}
           </div>
           @enderror
           <p class="offset-11 " id="characters"><span id="currentNumber">0</span>
            / <span>250</span></p>
          </div>
          <div class="row mt-3">
            <button type="submit" class="btn btn-warning  text-white">Send message</button>
          </div>

      </form>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $(document).ready(function(){
        $('.message-container').val('');
        if($('.message-container').val()==null ||$('.message-container').val()=="" || $('.message-container').val()==undefined){
            $('#characters').hide();
            $('#title').hide();
           }
        $('.message-container').keyup(function(e){
           $characterlength= $(this).val().length;
           $('#currentNumber').html($characterlength);
           $characterlength > 0 ? $('#characters').show():$('#characters').hide();
           $characterlength >250 ? $('#title').show():$('#title').hide();
           if($characterlength> 250){
                $('#currentNumber').hide();
           }
        })
    })
    </script>
@endsection
