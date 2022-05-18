<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Comment;
use App\Http\Requests\CommentRequest;

use App\Recipe;
use App\User;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');    
    }
    
    public function create($id)
    {
        $user = \Auth::user();
        $recipe = Recipe::find($id);
        return view('comments.create',[
           'title' => '質問投稿',
           'user' => $user,
           'recipe' => $recipe,
            
        ]);
    }
    
    public function store(CommentRequest $request)
    {
        Comment::create([
           'recipe_id' => $request->recipe_id,
           'user_id' => \Auth::user()->id,
           'body' => $request->body,
        ]);
        // return redirect()->route('recipes.index');
        return redirect()->route('recipes.show', ['id' => $recipe->id ]);
        // https://qiita.com/manbolila/items/767e1dae399de16813fb
    }
    
    public function destroy($id)
    {
        $comment = Comment::find($id);
        $comment->delete();
        return back();
    }
}
