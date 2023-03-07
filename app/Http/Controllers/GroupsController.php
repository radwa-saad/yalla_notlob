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

        $group_friend=new Group_Friend();
        $group_friend->user_id = auth()->id();
        $group_friend->group_id = $request->group_id;
        $group_friend->friend_id = $request->friends;
        $group_friend->save();
        //DB::table('group_friend')->insert(['user_id' => auth()->id(),'group_id'=> $group_friend->id]);

        // return "added";
        return to_route('groups.index' );
    }
    public function destroy1(Group_Friend $group_friend){
        $group_friend->delete();
        return to_route("groups.index");

    }
}
