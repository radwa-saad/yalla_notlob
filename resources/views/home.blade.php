@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center home">
        <div class="col-md-5 text-center m-5 p-3 latestOrder">
            <div class="card">
                <div class="card-header navo">
                    Latest Orders
                </div>
                <div class="card-body carbody">
                  <p class="card-text">
                    @foreach($latest_orders as $latest_order)

                    <p> {{$latest_order->order_for}} on {{$latest_order->created_at}}</p>
     
     
                     @endforeach
                  </p>
                </div>
              </div>
        </div>
        
        <div class="col-md-5 text-center m-5 p-3  frindActivity">
            <div class="card">
                <div class="card-header navo">
                    Frindes Activity
                </div>
                <div class="card-body ">
                  <p class="card-text">
                    @foreach($latest_orders as $latest_order)
                    <p class="textbody"><a  href="#" role="button" class="home">
                        {{ Auth::user()->name }}
                    </a> has created <a class="home" href="">an order</a> for {{$latest_order->order_for}} from
                    <a class="home" href=""> {{$latest_order->restaurant_name}}</a> </p>
                    @endforeach
                  </p>
                </div>
              </div>
            
        </div>
    </div>
    
</div>
@endsection
