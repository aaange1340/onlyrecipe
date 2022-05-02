<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Follow;
use App\User;
use Carbon\Carbon;

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
        return view('likes.index',[
            'user' => $user,
            'title' => 'お気に入りレシピ',   
            'recipes' => $recipes, 
            'data' => $data,
        ]);
    }
        
    
        

}
