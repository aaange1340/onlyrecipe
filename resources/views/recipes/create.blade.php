@extends('layouts.logged_in')

@section('title',$title)

@section('content')
<h1>{{ $title }}</h1>
<form method="POST" action="{{ route('recipes.store') }}" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="user_id" value="{{ $user->id??'' }}">
    <div class="form-group">
        <label>
            レシピ名：
        <input class="form-control" type="text" name="name">
        </label>
    </div>
    
    <div class="form-group">
        <label>材料
            <input class="form-control" type="hidden" name="recipe_id" value="">
            <input class="form-control" type="name" name="name">
            <input class="form-control" type="text" name="amount">
            <input class="form-control" type="text" name="unit">
        </label>
    </div>
    
    <div class="form-group">
        <label>
            カテゴリー：
            <select class="form-control" name="category_id">
                
                @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </label>
    </div>
    
    <div class="form-group">
        <label>
            画像を選択：
            <input type="file" name="image">
        </label>
    </div>
    
    <input class="button" type="submit" value="レシピを追加">
    
    
</form>

@endsection