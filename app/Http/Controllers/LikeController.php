<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Follow;

class LikeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');    
    }
    
    public function index(){
        $user = \Auth::user();
        $like_recipes = \Auth::user()->likeRecipes;
        return view('likes.index',[
            'user' => $user,
            'title' => 'お気に入りレシピ',   
            'like_recipes' => $like_recipes, 
        ]);
    }
        
    
        

}
