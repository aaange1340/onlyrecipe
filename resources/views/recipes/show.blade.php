@extends('layouts.logged_in')

@section('title',$title)

@section('content')

<h1>{{ $title }}</h1>

<ul class="flex">
<div class="container">

<h2>{{ $recipe->name }}</h2>
<div>
    {{ $recipe->category->name }}
@if($recipe->image !== '' )
    <a href="{{ route('recipes.show',$recipe) }}" class="image" style="background-image:url({{ \Storage::url($recipe->image) }})">
    </a>
@else
    <div class="image" style="background-image:url({{ asset('images/no_image.png') }})"></div>
@endif
<div>
<a href="{{ route('recipes.edit',$recipe) }}">編集</a>
    <form method="POST" action="{{ route('recipes.destroy',$recipe) }}">
        @csrf
        @method('delete')
        <input class="button" type="submit" value="削除">
    </form>
    
</div>
</div>
</div>



@endsection