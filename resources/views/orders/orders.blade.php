@extends('layouts.app')
@section('content')

<div class="container">
@if(session('message'))
    <div class="alert alert-success">{{session('message')}}</div>
@endif
    <div class="row mb-2">
        <span class="col-6 h1"> Orders</span>
        <a class="col-6 btn btn-primary w-25 py-1  me-0" href="{{route('orders.index')}}">Start new order</a>
    </div>

    <table class="table table-striped table-dark text-light">
            <thead>
                <th>Order</th>
                <th>Restaurant</th>
                <th>Invited</th>
                <th>Joined</th>
                <th>Status</th>
                <th>Actions</th>
            </thead>
            <tbody>
                @foreach($user->orders as $order)
                <tr>
                    <td class="text-danger">{{$order->order_for}}</td>
                    <td>{{$order->restaurant_name}}</td>
                    <td>{{$order->order_for}}</td>
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
                        <button  type="submit" class="btn btn-warning">Cancel</button>
                        </form>
                        @endif
                    </td>

                </tr>
                @endforeach
            </tbody>
    </table>
</div>




@endsection

