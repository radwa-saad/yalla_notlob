@extends('layouts.app')

@section('content')
<div class="container">
    <p class="h1">Groups</p>
    <div class="row pt-5 justify-content-center">
        <p class="col-1">Groups</p>
        <form action="{{route('groups.store')}}" method="POST" class="col-8 justify-content-btween">
            @csrf
            <input type="text" name="name" id="" class="col-7 form-control my-2">
            @if($errors->has('name'))
            <div class="alert alert-danger">
                <ul>
                    <li>{{$errors->first('name')}}</li>
                </ul>
            </div>
            @endif
            <input type="submit" value="Add" name=""  class="col-2 btn btn-success text-item-center">
        </form>
    </div>

    <div class="row py-5 justify-content-center">
        <div class="col-3 border py-3 mx-4 ">
            <div class="row ">
                @foreach ($user->groups as $group)
                    <p class="col-3 py-2">{{$group->name}}</p>
                    <span class="col-3 py-2"><button type="button" onClick='groupId(this)' data-id="{{$group->id}}" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">Add</button></span>
                    <span class="col-3 py-2"><a href='{{route("groups.show" , $group->id)}}' class="btn btn-primary">view</a></span>
                    <form  action="{{route('groups.destroy', $group->id)}}" method="POST" class="col-3 py-2">
                        @csrf
                        @method('delete')
                        <input  type='submit' class="btn btn-danger" value="delete">
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
                              <option value="{{$friend->id}}">{{$friend->email}}</option>
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

        <div class="col-7 border">
            <div class="row my-3 justify-content-around">
                <p class="col-3 h5">Friends Name</p>
                <input type="text" name="" id="" class="col-5">
                <input type="button" value="Add" class="col-2 btn btn-success">
            </div>

            <div class="row my-3 justify-content-around">
                @foreach($group_friends as $friend)
                <p class="col-2">{{$friend->email}}</p>
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
