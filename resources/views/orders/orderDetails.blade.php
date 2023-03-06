@extends('layouts.app')
@section('content')
    <section class='container'>
        <h4>Order Details</h4>
        <div class='row shadow' >
            <div class='col-md-8'>
                <table class=' table table-striped text-light table-dark'>
                    <tr>
                        <th>Person</th>
                        <th>Item</th>
                        <th>Amount</th>
                        <th>Price</th>
                        <th>Comment</th>
                    </tr>
                    {{-- @foreach($orderDetails as $order)
                    <tr>
                        <td>{{Auth::user()->name}}</td>
                        <td>{{$order->item}}</td>
                        <td>{{$order->quantity}}</td>
                        <td>{{$order->price}}</td>
                        <td>{{$order->comment}}</td>
                    </tr>
                    @endforeach --}}
                </table>
            </div>
            <div class='col-4'>
                <!-- Button trigger modal -->
                <a type="button" class='text-decoration-underline' data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    2 Friends invited click to view
                </a>
                <a type="button" class='text-decoration-underline' data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    2 Friends joined click to view
                </a>
                <!-- Modal -->
                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class='row' style='margin-top: 150px;'>
            <form class="row g-3" method='POST' action='{{route("orderdetails.store")}}'>
                @csrf
                <div class="col-md-2">
                    <label for="item" class="form-label">Item</label>
                    <input type="text" class="form-control" id="item" name='item'>
                </div>
                <div class="col-md-2">
                    <label for="amount" class="form-label">Amount</label>
                    <input type='number' class='form-control' id='amount' name='amount' min="1" max="5"/>
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
