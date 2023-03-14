<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Freind;
use App\Models\Friend_order;
use App\Models\Order_details;
use App\Models\Notifaction;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\StoreFreind_orderRequest;
use App\Http\Requests\UpdateOrderRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Mail\OrderMail;
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

        // dd($orders);
        return view('orders.index',compact('user','friends','friends_order','orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $user = User::find(auth()->id());
        $orders=Order::where('user_id','=',auth()->id())->paginate(2);
        foreach($orders as $order){
            $joined_count=Friend_order::where('order_id','=',$order->id)->where('status','=','joined')->count();
            $order->joined=$joined_count;

        }
        // dd($orders);

        return view('orders.orders',compact('user','orders'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderRequest $request)
    {
        //
// dd($request);
        $request->validate([
            'order_for'=>'required',
            'restaurant_name'=>'required',
            'menu_image'=>'required|image|mimes:png,jpg'
        ]);

        // dd($request->friend_id);

            $logged_in_user =Auth::user()->id;
            $data = $request->all();

            $data['user_id']=$logged_in_user;

                $file = $request->file('menu_image');
                $ext = $file->getClientOriginalExtension();
                $filename = time() . '.' . $ext;
                $file->move('uploads/order/', $filename);
                $path = "uploads/order/$filename";

                $data['menu_image'] = $path;

            $order =Order::create($data);

            $order->invites_count = count($request->invite_friends);
            $order->save();
            $friends_invites = [];
            foreach( $request->invite_friends as $k => $v ) {
                $data = collect([
                    'friend_id' => $request['invite_friends'][$k],
                    'order_id' => $order->id,

                ]);
                $friends_invites[] = $data->toArray();
                $friend=DB::table("friend_user")->where('id',$request->invite_friends[$k])->first();
                // dd($request);

                    Mail::to($friend->email)->send(new OrderMail($friend->email,$order->id));
                    $user=User::where('email',$friend->email)->first();
                    if($user){
                    $notifiaction= new Notifaction();
                    $notifiaction->sender_id=Auth::user()->id;
                    $notifiaction->receiver_id=$user->id;
                    $notifiaction->message=Auth::user()->name.' Invited You to her Order';
                    $notifiaction->status=0;

                    $notifiaction->save();
                }
            }

            Friend_order::insert( $friends_invites );

                # code...

            return  to_route('orders.create');
    }

    public function show(Order $order)
    {
        //
        $image = $order->menu_image;
        // dd($image);
        $count_invite = Friend_order::where('order_id',$order->id)->count();


        $friends_invites_orders = DB::table('friend_order')
        ->join('orders', 'friend_order.order_id', '=', 'orders.id')
        ->join('friend_user', 'friend_order.friend_id', '=', 'friend_user.id')
        ->where('friend_order.order_id', $order->id)
        ->select('friend_user.*')
        ->get();
        // dd($friends_invites_orders);
        if($order){
            $order_details = Order_details::where('order_id',$order->id)->get();
            // dd( $order_details);
            return view('orders.orderDetails',$data=['order_details'=>$order_details , 'order'=>$order ,'count_invite'=>$count_invite,'friends_invites_orders'=>$friends_invites_orders ,'image'=>$image]);
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
