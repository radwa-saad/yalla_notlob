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
    $ext = $file->getClientOriginalExtension();
    $filename = time().'.'.$ext;
    $file->move('uploads/friend/',$filename);
    $validatedData['image']="uploads/friend/$filename";
    Freind::create(['user_id' => auth()->id(),'email' => $validatedData['email'],'name' => $validatedData['name'],
    'image' => $validatedData['image']]);
    //  return "added";
        // $freind=Freind::create($request->all());
        // // DB::table('friend_user')->insert(['user_id' => auth()->id(),'email' => $freind->email]);
        return to_route('friends.index');
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
