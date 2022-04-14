@extends('layouts.logged_in')

@section('title',$title)

@section('content')
<h1>{{ $title }}</h1>
<form method="POST" action="{{ route('recipes.store') }}" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="user_id" value="{{ $user->id??'' }}">
    <div>
        <label>
            レシピ名：
        <input type="text" name="name">
        </label>
    </div>
    
    <div>
        <label>
            説明：
        </label>
    </div>
    
    <div>
        <label>
            カテゴリー：
            <select name="category_id">
                
                @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </label>
    </div>
    
    <div>
        <label>
            画像を選択：
            <input type="file" name="image">
        </label>
    </div>
    
    <input class="button" type="submit" value="レシピを追加">
    
    
</form>

@endsection