<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
    }
    
    public function show($id)
    {
        $user = \Auth::user();
        
        return view('user.show',[
           'title' => 'プロフィール',
           'user' => $user,
        ]);
        
    }
}
