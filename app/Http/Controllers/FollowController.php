<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Follow;

use App\User;

use App\Recipe;

class FollowController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');    
    }
    public function index()
    {
        $user = \Auth::user();
        $follow_users = \Auth::user()->follow_users;
        return view('follows.index',[
           'title' => 'フォロー一覧',
           'user' => $user,
           'follow_users' => $follow_users,
        ]);
    }
    
    public function store(Request $request)
    {
        $user = \Auth::user();
        Follow::create([
           'user_id' => $user->id,
           'follow_id' => $request->follow_id,
        ]);
        return back();
    }
    
    public function destroy($id)
    {
        // $user = User::find($id);
        $follow = \Auth::user()->follows->where('follow_id',$id)->first();
        $follow->delete();
        return back();
        
    }
    
    public function followerIndex()
    {
        $user = \Auth::user();
        
        $followers = $user->followers;
        return view('follows.followerIndex',[
           'title' => 'フォロワー一覧', 
           'followers' => $followers,
        ]);
    }
}
