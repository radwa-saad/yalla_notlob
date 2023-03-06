@extends('layouts.app')
@section('content')
    <section class='container'>
        <h4>Order Details</h4>
        <div class='row shadow' >
            <div class='col-md-6'>
                <table class=' table table-striped text-light table-dark'>
                    <tr>
                        <th>Person</th>
                        <th>Item</th>
                        <th>Amount</th>
                        <th>Price</th>
                        <th>Comment</th>
                    </tr>
                    @foreach($orderDetails as $order)
                    <tr>
                        <td>{{Auth::user()->name}}</td>
                        <td>{{$order->item}}</td>
                        <td>{{$order->quantity}}</td>
                        <td>{{$order->price}}</td>
                        {{-- <td>{{$order->comment}}</td> --}}
                    </tr>
                    @endforeach
                </table>
            </div>
            <div class='col-6'>
            </div>
        </div>
    </section>
@endsection
