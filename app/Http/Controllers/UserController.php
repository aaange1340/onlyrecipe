<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\UserRequest;

use Carbon\Carbon;

use App\User;

use App\Recipe;

use App\Category;

class UserController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function edit($id)
    {
        $user = User::find($id);
        
        return view('user.edit',[
           'title' => 'プロフィール編集',
           'user' => $user,
            
        ]);
    }
    
    private function saveImage($image)
    {
        $path = '';
        if(isset($image) === true){
            $path = $image->store('profile','public');
        }
        return $path;;
    }
    
    public function update(UserRequest $request,$id)
    {   
        $user = User::find($id);
        $path = $this->saveImage($request->file('image'));
        if($user->image !== ''){
            \Storage::disk('public')->delete('profile/'.$user->image);
        }
        $user->update($request->only([
            'profile','name',
        ]));
        if($path !== ''){
            $user->update([
               'image' => $path, 
            ]);
        }
        session()->flash('success','プロフィールを編集しました');
        return redirect()->route('user.show',$user);
    }
    
    public function show($id)
    {
        $user = User::find($id);
        $recipes = Recipe::all();
        foreach($recipes as $recipe){
        $data = Carbon::createFromFormat('Y-m-d H:i:s',$recipe->created_at)->format('Y年m月d日');
        }
        return view('user.show',[
           'title' => 'プロフィール',
           'user' => $user,
           'recipes' => $user->recipes()->latest()->get(),
           'data' => $data,
        ]);
        
    }
}
