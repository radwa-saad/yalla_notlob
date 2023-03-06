@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row">
        <span class="col-6 h1"> Orders</span>
        <a class="col-6 btn btn-primary" href="{{route('orders.index)}}">Start new order</a>
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
                @foreach()
                <tr>
                    <td>111</td>
                    <td>222</td>
                    <td>333</td>
                    <td>444</td>
                    <td>555</td>
                    <td>666</td>
                </tr>
                @endforeach
            </tbody>
    </table>

</div>


@endsection

