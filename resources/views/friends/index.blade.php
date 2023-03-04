@extends('layouts.app')
@section('content')
<div class="mt-5 frind m-auto">
    <h1>Friends</h1>

        <div class="form-group mb-2">

            <form action="{{route('friends.store')}}" method="POST" class="col-8 row justify-content-btween" enctype="multipart/form-data">
                @csrf
                <div class="col-5 w-50">
                    <label>Frind Name:</label>
                    <input type="text" name="name" class="form-control mb-1">
                    @if($errors->has('name'))
                    <div class="alert alert-danger">
                     <ul>
                      <li>{{$errors->first('name')}}</li>
                     </ul>
                    </div>
                    @endif
                </div>
                <div class="col-5 w-50">
                    <label>Frind Email:</label>
                    <input type="email" name="email" class=" form-control mb-1">
                    @if($errors->has('email'))
                    <div class="alert alert-danger">
                     <ul>
                      <li>{{$errors->first('email')}}</li>
                     </ul>
                    </div>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Image</label>
                    <input type="file" name="image" class="form-control" id="exampleInputPassword1">
                </div>
                @if($errors->has('image'))
                <div class="alert alert-danger">
                 <ul>
                  <li>{{$errors->first('image')}}</li>
                 </ul>
                </div>
                @endif
                <input type="hidden" name="user_id" value="{{auth()->id()}}">
                <input type="submit" value="Add" name=""  class="col-4 m-auto btn btn-success">



            </form>
        </div>
    <h1 class="mt-5">Your Friends List</h1>
    <div style="border:1px solid rgb(212, 207, 207);height:400px;width:800px; overflow:scroll" class="px-2">
        @foreach ($user->friends as $friend)
        <span class="mx-5">
        <img class="mb-5" src="{{asset("$friend->image")}}" alt="friend"
        style="width:70px; height:70px">
        <span class="col-4 mx-1">{{$friend->name}}</span>
        </span>
       @endforeach
    </div>

</div>

@endsection
