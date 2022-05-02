<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Recipe;

use App\Category;

use App\User;

use Carbon\Carbon;

class CategoryController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');    
    }
    
    public function index($id)
    {
        $category = Category::find($id);
        $user = \Auth::user();
        $recipes = Recipe::all();
        foreach($recipes as $recipe){
            $data = Carbon::createFromFormat('Y-m-d H:i:s',$recipe->created_at)->format('Y年m月d日');
        }
        
        return view('category.index',[
           'title' => $category->name,
           'category' => $category,
           'user' => $user,
           'data' => $data,
           'recipes' =>$recipes,
        ]);
    }
}
