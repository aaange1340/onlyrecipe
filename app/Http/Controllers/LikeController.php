<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function index(){
        return view('likes.index',[
            'title' => 'お気に入りレシピ',    
        ]);
    }
        
        

}
