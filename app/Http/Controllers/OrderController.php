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
use App\Mail\Subscriber;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $user = User::find(auth()->id());
        // dd($user);
        $friends =DB::table('friend_user')->where('user_id',auth()->id())->get();
        $friends_order =DB::table('friend_order')->where('user_id',auth()->id())->get();
        $orders=Order::all();
        return view('orders.index',compact('user','friends','friends_order','orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $user = User::find(auth()->id());
        $orders=Order::all();

        return view('orders.orders',compact('user','orders'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderRequest $request)
    {
        //
// dd($request->friend_id);
        $request->validate([
            'order_for'=>'required',
            'restaurant_name'=>'required',
            'menu_image'=>'required|image|mimes:png,jpg'
        ]);

        // dd($request->friend_id);

            $logged_in_user =Auth::user()->id;
            $data = $request->all();

            $data['user_id']=$logged_in_user;
            $order =Order::create($data);
            $myFriend =new Friend_order();
            $myFriend->order_id=$order->id;
            foreach ($request->friend_id as  $id) {
                $myFriend->friend_id=$id;
            }

            // dd($myFriend->friends);
            // dd($email);
            $myFriend->save();
            foreach ($request->friend_id as  $id) {
                # code...
                $email=DB::table("friend_user")->where('id',$id)->first();
                Mail::to($email->email)->send(new Subscriber($email->email));
            }

            return  to_route('orders.create');
    }

    public function show(Order $order)
    {
        //
        if($order){
            $order_details = Order_details::where('order_id',$order->id)->get();
            // dd( $order_details);
            return view('orders.orderDetails',$data=['order_details'=>$order_details , 'order'=>$order]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
        $order->status = 'finished';
        $order->save();
        $orders = Order::where('user_id',auth()->id())->get();
        return redirect()->back()->with('message', 'Your Order has been updated successfully!');
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
    public function destroy(Order $order)
    {
        //
        $order->status = 'cancel';
        $order->save();
        $order->delete();
        return redirect()->back()->with('message','Your Order has been Cancelled successfully!');
    }
}
