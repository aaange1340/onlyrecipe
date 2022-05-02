@extends('layouts.1column')

@section('title',$title)

<div class="title_wrapper"><h1>{{ $title }}</h1></div>
@section('main_content')
<form method="POST" action="{{ route('recipes.store') }}" enctype="multipart/form-data">
    @csrf
   
        
    <input type="hidden" name="user_id" value="{{ $user->id??'' }}">
    <div class="form-group">
        <label>
            レシピ名
        <input class="form-control" type="text" name="name">
        </label>
    </div>
    
    <div class="form-group">
        <label>材料
            <input class="form-control" type="hidden" name="recipe_id" value="">
            <div class="materials">
            <input class="form-control" type="name" name="material_name" placeholder="材料名">
            <input class="form-control" type="text" name="amount" placeholder="分量">
            <input class="form-control" type="text" name="unit" placeholder="単位">
                
            </div>
        </label>
    </div>
    
    <div class="form-group">
        <label>
            カテゴリー
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