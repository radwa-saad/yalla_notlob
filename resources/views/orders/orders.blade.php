@extends('layouts.app')
@section('content')

<div class="container">
@if(session('message'))
    <div class="alert alert-success">{{session('message')}}</div>
@endif
    <div class="row mb-2  my-4">
        <span class="col-6 h1"> Orders</span>
        <a class="col-6 btn navo w-25 py-1  me-0 pt-3" href="{{route('orders.index')}}">Start new order</a>
    </div>

    <table class="table my-5 ">
            <thead class="navo p-5">
                <th>Order</th>
                <th>Restaurant</th>
                <th>Invited</th>
                <th>Joined</th>
                <th>Status</th>
                <th colspan="3" class="text-center">Actions</th>
            </thead>
            <tbody style="color: white; font-wight:bold;">
                @foreach($user->orders as $order)
                <tr>
                    <td style="color: #f71414 ;" class="h5">{{$order->order_for}}</td>
                    <td>{{$order->restaurant_name}}</td>
                    <td>{{$order->invites_count}}</td>
                    <td>{{$order->order_for}}</td>
                    <td>{{$order->status}}</td>
                    <td>
                        <a href="{{route('orders.show',$order->id)}}" class="btn btn-primary">View</a>
                    </td>
                    <td>
                            @if ($order->status == 'waiting')
                                <a href="{{route('orders.edit',$order->id)}}" class="btn btn-success">Finish </a>
                    </td>
                    <td>
                        <form action="{{route('orders.destroy',$order->id)}}" method="post">
                            @csrf
                            @method('delete')
                            <button  type="submit" class="btn btn-danger">Cancel</button>
                        </form>
                        @endif
                    </td>

                </tr>
                @endforeach
            </tbody>
    </table>
      <div class="d-flex">
    {{-- {{$orders->links('pagination::bootstrap-5')}} --}}
  </div>
</div>




@endsection

