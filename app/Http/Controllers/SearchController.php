<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Recipe;

use App\User;

class SearchController extends Controller
{
    // public function index(Request $request)
    // {
    //     $user = \Auth::user();
    //     $recipe = Recipe::all();
    //     $query = Recipe::query();
    //     $search = $request->input('search');
    //     if($search !== ''){
    //         $spaceConversion = mb_convert_kana($search,'s');
    //         $wordArraySearched = preg_split('/[\s,]+/',$spaceConversion,-1,PREG_SPLIT_NO_EMPTY);
    //         foreach($wordArraySearched as $value){
    //             $query->where('name','like','%'.$value.'%');
    //         }
            
    //     }
        
    //     return view('recipes.index')
    //     ->with([
    //         'recipe' => $recipe,
    //         'search' => $search,
    //         'title' => '検索結果',
    //     ]);
    // }
}
