@extends('layouts.app')
@section('content')
    <section class='container'>

    @if(session('message'))
    <div class="alert alert-success">{{session('message')}}</div>
    @endif
    {{-- {{$image}} --}}
    {{-- {{dd($order_details)}} --}}
        <h4>Order Details</h4>
        <div class='row shadow' >
            <div class='col-md-8'>
                <table class=' table freindlist' style="color: white;">
                    <tr class="navo">
                        <th>Person</th>
                        <th>Item</th>
                        <th>Amount</th>
                        <th>Price</th>
                        <th>Comment</th>
                    </tr>
                    @forelse ($order_details as $item)
                    <tr>

                        <th style="color:#f71414; " scope="row">{{Auth::user()->name}}</th>
                        <td>{{$item->item}}</td>
                        <td>{{$item->quantity}}</td>
                        <td>{{$item->price}} Le</td>
                        <td>{{$item->comment}}</td>

                    </tr>


                    @empty

                    <tr class="text-center">
                        <th colspan="4" class="alert alert-danger">There is no Items In This Order</th>

                     </tr>

                    @endforelse
                </table>
            </div>

            <div class='col-4 pt-1'>
                <!-- Button trigger modal -->
                <button type="button" class='text-decoration-underline btn navo my-1' data-bs-toggle="modal" data-bs-target="#exampleModal">
                {{$count_invite}} Friends invited click to view
                </button>
                <!-- Modal -->
                                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header navo">
                            <h5 class="modal-title" id="exampleModalLabel">Invited Friends</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                        @foreach($friends_invites_orders as $friend)
                        <div class="row">
                        <img class="mb-5 col-3 frinimg" src="{{asset("$friend->image")}}" alt="">
                                <span class="col-8 text-dark pt-2">{{$friend->name}}</span>
                            </div>
                            @endforeach
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                        </div>
                    </div>
                    </div>
</div>

        <div class='row mt-3'>
            <form class="row g-3 " method='POST' action='{{route("orderdetails.store")}}'>
                @csrf
                <input type="hidden" name="order_id" value="{{$order->id}}">
                <div class="col-md-2">
                    <label for="item" class="form-label">Item</label>
                    <input type="text" class="form-control" id="item" name='item'>
                </div>
                <div class="col-md-2">
                    <label for="amount" class="form-label">Amount</label>
                    <input type='number' class='form-control' id='amount' name='quantity' min="1" max="5"/>
                </div>
                <div class="col-md-2">
                    <label for="price" class="form-label">Price</label>
                    <input type="number" class="form-control" id="price" name='price' min='4'>
                </div>
                <div class="col-md-3">
                    <label for="comment" class="form-label">Comment</label>
                    <input type="text" class="form-control" id="comment" name='comment'>
                </div>
                <div class="col-1 mt-5">
                    <button type="submit" class="btn btn-success rounded-5">Add</button>
                </div>
            </form>
        </div>
    </section>
@endsection
