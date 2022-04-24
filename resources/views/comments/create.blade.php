@extends('layouts.logged_in')

@section('title',$title)

@section('content')
<div class="form-group">
<h1>コメント投稿</h1>
<form method="post" action="{{ route('comments.store') }}">
    @csrf
    <input type="hidden" name="recipe_id" value="{{ $recipe->id }}">
    <input class="form-control" type="text" name="body">
    <input class="button" type="submit" value="送信">
</form>
    
</div>

@endsection