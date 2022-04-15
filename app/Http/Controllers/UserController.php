<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\UserRequest;

use App\User;

class UserController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function edit()
    {
        $user = \Auth::user();
        
        return view('user.edit',[
           'title' => 'プロフィール編集',
           'user' => $user,
            
        ]);
    }
    
    public function update(UserRequest $request)
    {   
        $user = \Auth::user();
        $user->update($request->only([
            'profile','name',
        ]));
        
        return redirect()->route('user.show',$user);
    }
    
    public function show($id)
    {
        $user = User::find($id);
        
        return view('user.show',[
           'title' => 'プロフィール',
           'user' => $user,
        ]);
        
    }
}
