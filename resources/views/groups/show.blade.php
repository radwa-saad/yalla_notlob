@extends('layouts.app')

@section('content')
<div class="p-3 px-5 ">
    <p class="h1">Groups</p>
    <div class="row pt-3 justify-content-center">
        <p class="col-1 pt-3">Groups</p>
        <form action="{{route('groups.store')}}" method="POST" class="col-8 row justify-content-btween">
            @csrf
            <div class="col-7">
                <input type="text" name="name" id="" class="col-6 form-control my-2">

            </div>
            @if($errors->has('name'))
            <div class="alert alert-danger">
                <ul>
                    <li>{{$errors->first('name')}}</li>
                </ul>
            </div>
            @endif
            <div class="col-5 pt-2">

            <input type="submit" value="Add" name=""  class=" btn btn-success text-item-center">
            </div>
        </form>
    </div>

    <div class="row py-5 justify-content-center">
        <div class="col-4  py-3 mx-4 ">
            <div class="row ">
                @foreach ($user->groups as $group)
                    <p class="col-3 py-2">{{$group->name}}</p>
                    <span class="col-3 py-2"><button type="button" onClick='groupId(this)' data-id="{{$group->id}}" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">Add</button></span>
                    <span class="col-3 py-2"><a href='{{route("groups.show" , $group->id)}}' class="btn btn-primary">view</a></span>
                    <form  action="{{route('groups.destroy', $group->id)}}" method="POST" class="col-3 py-2">
                        @csrf
                        @method('delete')
                        <input  type='submit' class="btn btn-danger" value="delete" onclick="return confirm('Are you sure you want to delete this group? ') ">
                    </form>
                @endforeach
            </div>
        </div>

        <!-- Add button popup -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add your Group member</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('groups.store1')}}" method="POST" class="col-8  justify-content-btween">
                        @csrf
                        <select name="friends" id=""  class="form-select" aria-label="Default select example">
                            @foreach($friends as $friend)
                              <option value="{{$friend->id}}">{{$friend->name}}</option>
                            @endforeach
                          </select>
                        <div class="modal-footer">
                            <input type="hidden" name="group_id" id='group_id'>
                            <input type="submit" value="Add" name="" data-bs-dismiss="modal" class="col-2 btn btn-success text-item-center">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

        <div class="col-7 cool">
            <div class="row my-3 justify-content-around">
                <p class="col-3 h5">Friend Name</p>
                <form action="{{route('groups.store1')}}" method="POST" class="col-9 row justify-content-btween">
                    @csrf
                    <select name="friends" id="" style="border-radius: 10px;"  class="col-7 mx-3" aria-label="Default select example ">
                        @foreach($friends as $friend)
                          <option value="{{$friend->id}}">{{$friend->name}}</option>
                        @endforeach
                    </select>
                    <input type="hidden" name="group_id" id='group_id' class="col-1">
                    <input type="submit" value="Add" name="" data-bs-dismiss="modal" class="col-2 btn btn-success text-item-center">
                </form>
            </div>

            <div class="my-3 justify-content-around p-2 row ">
                @foreach ($group_friends as $friend)

                <div class="row col-4">
                    <img class="mb-5 col-6 frinimg" src="{{asset("$friend->image")}}" alt="friend">
                    <p class="col-3 pt-3">{{$friend->name}}</p>
                    <form action="{{ route('groups.delete') }}" method="post" class="col-3 py-2">
                        @csrf
                        @method('delete')
                        <input type="hidden" name="group_id" value="{{ $group->id }}">
                        <input type="hidden" name="friend_id" value="{{ $friend->id }}">
                        <input  type='submit' class="btn btn-danger" value="unfriend" onclick="return confirm('Are you sure you want to delete this friend? ') ">


                        </button>

                    </form>
                   </div>
               @endforeach
            </div>
        </div>
    </div>
</div>
<script>
    function groupId(e){
        let id= e.getAttribute('data-id');
        document.querySelector('#group_id').value = id
    }
</script>
@endsection
