<?php

namespace App\Http\Controllers;

use App\Models\Freind;
use App\Models\User;
use App\Http\Requests\StoreFreindsRequest;
use App\Http\Requests\UpdateFreindsRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Mail\Subscriber;
use Illuminate\Support\Facades\Mail;
use App\Models\Notifaction;


class FreindsController extends Controller
{
    public function index(){
        $friends=Freind::where('user_id',auth()->id())->get();
        // dd($friends);
        $user = User::find(auth()->id());
        return view('friends.index',compact('user','friends'));
    }

    public function store(StoreFreindsRequest $request){

    //     $validatedData = $request->validated();
    //  $file = $request->file('image');
    //  $ext = $file->getClientOriginalExtension();
    //  $filename = time().'.'.$ext;
    //  $file->move('uploads/friend/',$filename);
    //  $validatedData['image']="uploads/friend/$filename";
    //  $logged_in_user =Auth::user()->id;
    //  $data = $request->all();
    //  $data['user_id']=$logged_in_user;
    //     Freind::create($data);
    //     //return "added";
    //     return to_route('friends.index');
    $validatedData = $request->validated();
    $file = $request->file('image');
    if ($file) {
    $ext = $file->getClientOriginalExtension();
    $filename = time().'.'.$ext;
    $file->move('uploads/friend/',$filename);
        # code...
        $validatedData['image']="uploads/friend/$filename";
        Freind::create(['user_id' => auth()->id(),'email' => $validatedData['email'],'name' => $validatedData['name'],
        'image' => $validatedData['image']]);
    }else{
        return \Redirect::back()->with("noImg","You Must Enter A Profile Picuure");
    }
    //  return "added";
        // $freind=Freind::create($request->all());
        // // DB::table('friend_user')->insert(['user_id' => auth()->id(),'email' => $freind->email]);
        // return to_route('friends.index');
        $email = $request->all()['email'];

        if(!User::where('email',$email)->first()){
            Mail::to($email)->send(new Subscriber($email));
            return to_route('friends.index')->with('message', 'this email is not found in system, we have sent an invitation to him !');
        }

        $new_friend = new Freind();
        $new_friend->name = $request->name;
        $new_friend->email = $request->email;
        $new_friend->user_id = auth()->id();

        if($new_friend->save())
        {
            // $notify=Notifaction::create([
            //     'sender_id' => auth()->id(),
            //     'receiver_id' => User::where('email',$request->email)->first()->id,
            //     'status' => false,

            // ]);
// dd($notify);
            return to_route('friends.index')->with('message', 'friend is added successfully');
        }else{
            return to_route('friends.index')->with('error', 'error in saving friend');
        }


        // Mail::to($request->email)->send(new Subscriber($request->email));

        // return redirect('friends')->with('message','Friend Added successfully');
    }
    public function destroy(Freind $friend)
    {
        //
        // $id=$group->group_id;
        // DB::table('groups')->delete($id);
        $friend->delete();
        return to_route("friends.index");
    }
        /**
     * Display a listing of the resource.
     */
//     public function index(): Response
//     {
//        return view('friends.freinds');
//     }

//     /**
//      * Show the form for creating a new resource.
//      */
//     public function create(): Response
//     {
//         //
//     }

//     /**
//      * Store a newly created resource in storage.
//      */
//     public function store(StoreFreindsRequest $request): RedirectResponse
//     {
//         //
//     }

//     /**
//      * Display the specified resource.
//      */
//     public function show(Freinds $freinds): Response
//     {
//         //
//     }

//     /**
//      * Show the form for editing the specified resource.
//      */
//     public function edit(Freinds $freinds): Response
//     {
//         //
//     }

//     /**
//      * Update the specified resource in storage.
//      */
//     public function update(UpdateFreindsRequest $request, Freinds $freinds): RedirectResponse
//     {
//         //
//     }

//     /**
//      * Remove the specified resource from storage.
//      */
//     public function destroy(Freinds $freinds): RedirectResponse
//     {
//         //
//     }
}
