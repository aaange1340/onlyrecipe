<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NationalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $nationalities = Nationality::all();
        $user = \Auth::user();
        
        return view('nationaities.index',[
           'title' => '国別のレシピ',
           'nationalities' => $nationalities,
            
        ]);
        
    }
}
