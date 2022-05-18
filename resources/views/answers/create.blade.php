@extends('layouts.1column')

@section('title',$title)

@section('main_content')
<div class="form-group">
<h1>質問回答</h1>
<form method="POST" action="{{ route('answers.store') }}">
    @csrf
    <input type="hidden" name="recipe_id" value="{{ $recipe->id }}">
    <input type="hidden" name="comment_id" value="{{ $comment->id }}">
    <textarea class="form-control" name="body"></textarea>
    <input class="button button_comment" type="submit" value="送信">
</form>
    
</div>

@endsection