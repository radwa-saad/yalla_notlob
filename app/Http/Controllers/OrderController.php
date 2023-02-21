<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Friend_order;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\StoreFreind_orderRequest;
use App\Http\Requests\UpdateOrderRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $user = User::find(auth()->id());
        $friends =DB::table('friend_user')->where('user_id',auth()->id())->get();
        $friends_order =DB::table('friend_order')->where('user_id',auth()->id())->get();

        return view('orders.index',compact('user','friends','friends_order'));
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
    public function store(StoreOrderRequest $request)
    {
        //
        $request->validate([

            'order_for'=>'required',
            'restaurant_name'=>'required',
            'menu_image'=>'required|image|mimes:png,jpg'
            ]);


            $logged_in_user =Auth::user()->id;
            $data = $request->all();
            $data['user_id']=$logged_in_user;

            $order =Order::create($data);
            $myFriend =new Friend_order();
            $myFriend->order_id=$order->id;
            $myFriend->friends=$request->friends;
            $myFriend->save();



        //  $data = $request->all();
        //  DB::table('orders')->insert(['user_id' => auth()->id(),'order_for' =>
        //  $data->order_for,'restaurant_name'=>$data->restaurant_name,'menu_image'=>$data->menu_image]);

        //   DB::table('friend_order')->insert(['user_id'=>auth()->id(),'friends'=>$data->friends]);
        //   return 'added';
      return  to_route('orders.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order): Response
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order): Response
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderRequest $request, Order $order): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order): RedirectResponse
    {
        //
    }
}
