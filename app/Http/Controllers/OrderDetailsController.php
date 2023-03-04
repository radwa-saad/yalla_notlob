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

class OrderDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('orders/orderDetails');
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
    public function store(Request $request)
    {
        dd($request);
        $request->validate([
            'item' => 'required',
            'quantity'=>'required',
            'price' => 'required',
            // 'comment' => 'required',
            'order_id' => 'required',
        ]);

        $orderdetail = new Order_details();
        // dd($orderdetail);
        $orderdetail->item = $request->item;
        $orderdetail->quantity = $request->quantity;
        $orderdetail->price = $request->price;
        // $orderdetail->comment = $request->comment;
        $orderdetail->order_id = $request->order_id;
        $orderdetail->save();
        $orderDetails = Order_details::where('order_id', $request->order_id )->get();
        // dd($orderDetals);
        // return view('orderdetails.index' , compact('orderDetails'));
        return redirect()->back()->with('success', 'Your item has been added successfully!',['orderDetails'=>$orderDetails]);
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
