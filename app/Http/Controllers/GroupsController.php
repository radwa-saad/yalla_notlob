<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\User;
use App\Models\Group_Friend;
use App\Models\UserGroup;
use Illuminate\Http\Request;
use App\Http\Requests\StoreGroupsRequest;
use App\Http\Requests\StoreGroupFriendRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Mail\Subscriber;
use Illuminate\Support\Facades\Mail;
class GroupsController extends Controller
{
    public function index(){
        // $userGroups = UserGroup::where('user_id', auth()->id())->with('groups')->get();
        $user = User::find(auth()->id());
        $friends =DB::table('friend_user')->where('user_id',auth()->id())->get();
        $group_friend =DB::table('group_friend')->where('user_id',auth()->id())->get();

        return view('groups.index',compact('user','friends','group_friend'));
    }

    public function show($id){
        $user = User::find(auth()->id());
        $friends =DB::table('friend_user')->where('user_id',auth()->id())->get();
        $group_friends = DB::table('group_friend')
        ->join('groups', 'group_friend.group_id', '=', 'groups.id')
        ->join('friend_user', 'group_friend.friend_id', '=', 'friend_user.id')
        ->where('group_friend.group_id', $id)
        ->select('friend_user.*')
        ->get();

        return view('groups.show' , compact('user' , 'friends' , 'group_friends'));
    }

    public function store(StoreGroupsRequest $request){
        $request->validate([
         'name'=>'required',

        ]);
        $group=Group::create($request->all());
        // $group_friend=request()->all();
        DB::table('group_user')->insert(['user_id' => auth()->id(),'group_id' => $group->id]);


        // DB::table('group_friend')->insert($group_friend);


        // $logged_in_user =Auth::user()->id;
        // $data = $request->all();
        // $data['user_id']=$logged_in_user;

        // $group =Group::create($data);
        // $group_friend =new Group_Friend();
        // $group_friend->group_id=$group->id;
        // $group_friend->friend_id=$request->friend_id;
        // $group_friend->save();

       return redirect('groups')->with('message','Group added successfully');
    }

    public function destroy(Group $group)
    {
        //
        // $id=$group->group_id;
        // DB::table('groups')->delete($id);
        $group->delete();
        return to_route("groups.index");
    }

    public function store1(StoreGroupFriendRequest $request){
        // dump($request->all());
        $group_friend=new Group_Friend();
        $group_friend->user_id = auth()->id();
        $group_friend->group_id = $request->group_id;
        $group_friend->friend_id = $request->friends;
        $group_friend->save();
        // User::where('id',$request->friends)->get('email');
        //DB::table('group_friend')->insert(['user_id' => auth()->id(),'group_id'=> $group_friend->id]);

        // return "added";

        // Mail::to($request->user())
        // ->cc($moreUsers)
        // ->bcc($evenMoreUsers)
        // ->queue(new Subscriber($request->email));
        // dd($email);
        $email=DB::table("friend_user")->where('id',$request->friends)->first();
        Mail::to($email->email)->send(new Subscriber($email->email));

        return to_route('groups.index' );
    }
    public function destroy1(Group_Friend $group_friends){
        $group_friends->delete();
        return to_route("groups.index");
    }
    public function delete(Request $request){

        $friend = Group_friend::where('group_id','=',$request->group_id )
        ->where('friend_id','=',$request->friend_id )
        ->first();
       $friend->delete();


// return redirect()->back()->with('message', ' Friend has been Delete from Groub successfully!');
      return to_route('groups.index');

    }
}
