<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Order_details;
use App\Models\User;
use App\Models\Order;
use App\Models\Friend_order;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreOrderDetailsRequest;
use Illuminate\Support\Facades\DB;


class OrderDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $user = User::find(auth()->id());
        $orders = DB::table('orders')->where('user_id',auth()->id())->get();
        return view('orders/orderDetails' , compact('user' , 'orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderDetailsRequest $request)
    {

    $orderdetail = new Order_details();
    $orderdetail->item = $request->item;
    $orderdetail->quantity = $order->quantity;
    $orderdetail->price = $order->price;
    $orderdetail->comment = $order->comment;
    $orderdetail->order_id = $order->order_id;
    $orderdetail->save();
    $orderDetails = Order_details::where('order_id', $order->order_id)->get();
    dd($orderDetails);
    // return route('orderdetails.index');
    // return redirect()->back()->with('success', 'Your item has been added successfully!',['orderDetails'=>$orderDetails]);
}

    /**
     * Display the specified resource.
     */
    public function show(string $id): Response
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): Response
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        //
    }
}
