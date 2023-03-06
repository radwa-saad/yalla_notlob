@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row">
        <span class="col-6 h1"> Orders</span>
        <a class="col-6 btn btn-primary" href="{{route('orders.index')}}">Start new order</a>
    </div>

    <table class="table">
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
                    <td>{{$order->order_for}}</td>
                    <td>
                        <a href="{{route('orders.show',$order->id)}}" class="">View</a>
                        <a href="">Finish</a>
                        <a href="">Cancel</a>
                    </td>

                </tr>
                @endforeach
            </tbody>
    </table>
</div>


@endsection

