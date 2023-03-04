@extends('layouts.app')
@section('content')

<div class="container row">
<div class="col-6">
   <div class="mt-5 w-50 m-auto">
    <h1>Add Order</h1>

    <form action="{{route('orders.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
          <label class="form-label">Order for</label>
          <select name="order_for" class="form-select" aria-label="Default select example">
            <option selected disabled>Open this select menu</option>
            <option value="1">Breakfast</option>
            <option value="2">Lunch</option>
            <option value="3">Dinner</option>
          </select>
        </div>
        @if($errors->has('order_for'))
            <div class="alert alert-danger">
             <ul>
              <li>{{$errors->first('order_for')}}</li>
             </ul>
            </div>
            @endif
        <div class="mb-3">
          <p class="fs-5">Write the restaurant name</p>
          <label for="exampleInputPassword1" class="form-label">From</label>
          <input type="text" name="restaurant_name" class="form-control" id="exampleInputPassword1">
        </div>
        @if($errors->has('restaurant_name'))
            <div class="alert alert-danger">
             <ul>
              <li>{{$errors->first('restaurant_name')}}</li>
             </ul>
            </div>
            @endif
        <div class="mb-3">
          <p class="fs-5">You can write a friend name or group</p>
          <label for="exampleInputPassword1" class="form-label">Friends</label>
          <select name="friends" id=""  class="form-select" aria-label="Default select example">

            @foreach($friends as $friend)
              <option value="{{$friend->id}}">{{$friend->name}}</option>
            @endforeach
          </select>
        </div>
        @if($errors->has('friends'))
            <div class="alert alert-danger">
             <ul>
              <li>{{$errors->first('friends')}}</li>
             </ul>
            </div>
            @endif
        <div class="mb-3">
          <label for="exampleInputPassword1" class="form-label">Menu Image</label>
          <input type="file" name="menu_image" class="form-control" id="exampleInputPassword1">
        </div>
        @if($errors->has('menu_image'))
        <div class="alert alert-danger">
         <ul>
          <li>{{$errors->first('menu_image')}}</li>
         </ul>
        </div>
        @endif

        <button type="submit" class="btn btn-primary">Publish</button>
      </form>


   </div>




</div>
<div class="col-6">
<div class="mt-5 w-50 m-auto">
<h1>Friends Invited</h1>
{{-- {{dd($orders)}} --}}
<div>
@foreach($user->$friends_order as $friend_order)
<p>{{$friend_order->friends}}</p>
@endforeach
</div>
</div>

</div>

</div>



@endsection
