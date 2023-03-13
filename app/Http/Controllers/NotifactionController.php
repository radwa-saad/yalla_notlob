<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notifaction;

class NotifactionController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function addNotifaction($sender_id,$receiver_id){

        $sender = User::find($sender_id);
        $receiver = User::find($receiver_id);

        $notify = new Notifaction();
        $notify->message = "Unreed Invitation";
        $notify->status = false;
        $notify->sender_id = $sender_id;
        $notify->receiver_id = $receiver_id;
        $notify->save();

    }

    public function getAll()
    {
        // return 111;
        $all = Notifaction::where('receiver_id',auth()->user()->id)->where('status',false)->with('sender')->get();
        // dd($all);
        return $all;
    }

    public function changeSeen($id){
        Notifaction::where('receiver_id',auth()->user()->id)->update(['status'=>true]);
        return true;
    }
}
