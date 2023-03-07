@extends('layouts.app')
@section('content')
<div class="mt-5 frind m-auto">
    @if(session('message'))
    <div class="alert alert-success">{{session('message')}}</div>
    @endif
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
                <input type="submit" value="Add" name=""  class="col-4 m-auto btn butt">



            </form>
        </div>
    <h1 class="mt-5">Your Friends List</h1>
    <div class="p-2 row freindlist">

        @foreach ($user->friends as $friend)
       <div class="row col-4">
        <img class="mb-5 col-6 frinimg" src="{{asset("$friend->image")}}" alt="friend">
        <p class="col-2 pt-3">{{$friend->name}} </p>
        <form  action="{{route('friends.destroy', $friend->id)}}" method="POST" class="col-3 py-2">
            @csrf
            @method('delete')
            <input  type='submit' class="btn btn-danger" value="unfriend" onclick="return confirm('Are you sure you want to delete this friend? ') ">
        </form>
       </div>
       @endforeach
    </div>

</div>

@endsection
