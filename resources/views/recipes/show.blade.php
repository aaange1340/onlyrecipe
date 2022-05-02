@extends('layouts.1column')

@section('title',$title)

@section('main_content')

<div class="title_wrapper"><h1>{{ $title }}</h1></div>

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
        <input class="button" type="submit" value=&#xf2ed; class="fas">
    </form>
    
    <ul>
        @forelse($recipe->comments as $comment)
        <li>コメント</li>
        <li>{{ $comment->user->name }}{{ $comment->created_at }}:{{ $comment->body }}</li>
        @if($comment->user->id === $user->id)
        <form method="POST" action="{{ route('comments.destroy',$comment) }}">
            @csrf
            @method('delete')
            @if(\Auth::user()->id === $recipe->user->id)
            <input class="button" type="submit" value=&#xf2ed; class="fas">
            @endif
        </form>
        @endif
        @empty
        <li>コメントはありません</li>
        @endforelse
    </ul>
</div>
</div>
</div>



@endsection