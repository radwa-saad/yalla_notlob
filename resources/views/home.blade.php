@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 text-center m-5 p-3 latestOrder">
            <h2>Latest Orders</h2>
            <div>
                @foreach($latest_orders as $latest_order)

               <p> {{$latest_order->order_for}} on {{$latest_order->created_at}}</p>


                @endforeach
            </div>
        </div>
        <div class="col-md-6 text-center m-5 p-3  frindActivity">
            <h2>Frindes Activity</h2>
            <div>
                @foreach($latest_orders as $latest_order)
                <p><a  href="#" role="button" >
                    {{ Auth::user()->name }}
                </a> has created <a href="">an order</a> for {{$latest_order->order_for}} from
                <a href=""> {{$latest_order->restaurant_name}}</a> </p>
                @endforeach
            </div>
        </div>
        </div>
    </div>
</div>
@endsection
