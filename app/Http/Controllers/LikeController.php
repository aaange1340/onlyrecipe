<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Follow;
use App\User;
use Carbon\Carbon;
use App\Recipe;

class LikeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');    
    }
    
    public function index(){
        $user = \Auth::user();
        $recipes = \Auth::user()->likeRecipes;
        foreach($recipes as $recipe){
            $data = Carbon::createFromFormat('Y-m-d H:i:s',$recipe->created_at)->format('Y年m月d日');
        }
        $like_recipes = Recipe::withCount('likes')->orderBy('likes_count','desc')->take(3)->get();
        return view('likes.index',[
            'user' => $user,
            'title' => 'お気に入りレシピ',   
            'recipes' => $recipes, 
            'data' => $data,
            'like_recipes' => $like_recipes,
        ]);
    }
        
    
        

}
