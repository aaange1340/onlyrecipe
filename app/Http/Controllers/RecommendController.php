<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use Carbon\Carbon;

use App\User;

use App\Recipe;

class RecommendController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {   
        $user = \Auth::user();
        $recommended_users = User::recommend($user->id)->get();
        $recipes = Recipe::all();
         foreach($recipes as $recipe){
            $data = Carbon::createFromFormat('Y-m-d H:i:s',$recipe->created_at)->format('Y年m月d日');
        }
        return view('recommend_user.index',[
            'title' => 'おすすめユーザー',
            'recommended_users' => $recommended_users,
            'recipes' => $recipes,
            'user' => $user,
            'data' => $data,
         ]);
    }
}
