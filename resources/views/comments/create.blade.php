@extends('layouts.1column')

@section('title',$title)

@section('main_content')
<div class="form-group">
<h1>質問投稿</h1>
<form method="post" action="{{ route('comments.store') }}">
    @csrf
    <input type="hidden" name="recipe_id" value="{{ $recipe->id }}">
    <textarea class="form-control" name="body"></textarea>
    <input class="button button_comment" type="submit" value="送信">
</form>
    
</div>

@endsection