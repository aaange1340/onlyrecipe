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
            <input type="button" value="+" class="add pluralBtn">
            <input type="button" value="－" class="del pluralBtn">
            <input class="form-control" type="name" name="material_name" placeholder="材料名">
            <input class="form-control" type="text" name="amount" placeholder="分量">
            <select class="form-control" name="unit">
            
                 <option value="">小さじ</option>
                 <option value="">大さじ</option>
                 <option value="">g</option>
                 <option value="">cc</option>
                 <option value="">カップ</option>
            </select>    
                
            </div>
        </label>
    </div>
    
    <div class="form-group">
        <label>
            作り方
            <textarea></textarea>
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
   
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
$(document).on("click", ".add", function() {
    $(this).parent().clone(true).insertAfter($(this).parent());
});
$(document).on("click", ".del", function() {
    var target = $(this).parent();
    if (target.parent().children().length > 1) {
        target.remove();
    }
});
</script>
@endsection