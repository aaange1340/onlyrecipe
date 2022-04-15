@extends('layouts.logged_in')

@section('title',$title)

@section('content')

<h1>{{ $title }}</h1>

<form method="POST" action="{{ route('recipes.update',$recipe) }}" enctype="multipart/form-data">
    @csrf
    @method('PATCH')
<div class="form-group">
    <label>
        レシピ名：
        <br>
        <input class="form-control" type="name" name="name" value="{{ old('name',$recipe->name) }}">
    </label>
</div>

<div class="form-group">
    <label>
        材料：
        <br>
        
    </label>
</div>

<div class="form-group">
<label>
    カテゴリー：
    <br>
    <select name="category_id" class="form-control">
        @foreach($categories as $category)
        <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
    </select>
</label>
</div>

<div class="form-group">
<label>
    画像：
    @if($recipe->image !== '')
    <div class="image" style="background-image:url({{ \Storage::url($recipe->image) }})"></div>
    @else
    <div class="image" style="background-image:url({{ asset('images/no_image.png') }})"></div>
    @endif
    <input type="file" name="image">
</label>
</div>

<div class="form-group">
    <input class="button" type="submit" value="更新">
</div>

</form>



@endsection