<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Answer;

use App\Comment;

use App\Http\Requests\AnswerRequest;

use App\Recipe;

use App\User;

class AnswerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        
    }
    
    public function create($id)
    {
        $user = \Auth::user();
        $comment = Comment::find($id);
        return view('answers.create',[
           'title' => '回答',
           'user' => $user,
           'comment' => $comment,
        ]);
    }
    
    public function store(AnswerRequest $request)
    {
        Answer::create([
           'comment_id' => $request->comment_id,
           'user_id' => \Auth::user()->id,
           'body' => $request->body,
        ]);
        // return redirect()->route('recipes.show', ['id' => ]);
        return redirect()->route('answers.index');
    }    
    
    public function destroy($id)
    {
        $answer = Answer::find($id);
        $answer->delete();
        return back();
    }
}
