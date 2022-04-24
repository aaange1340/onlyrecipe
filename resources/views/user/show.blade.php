@extends('layouts.logged_in')

@section('title',$title)

@section('content')

<h1>{{ $title }}</h1>

<dl>
    <dt>ユーザー名</dt>
    <dd>{{ $user->name }}
    @if($user->id != \Auth::user()->id)
    @if(Auth::user()->isFollowing($user))
     <form method="post" action="{{ route('follows.destroy',$user) }}" class="follow">
        @csrf
        @method('delete')
        <input type="submit" value="フォロー解除">
     </form>
    @else
     <form method="post" action="{{ route('follows.store') }}" class="follow">
        @csrf
        <input type="hidden" name="follow_id" value="{{ $user->id }}">
        <input type="submit" value="フォロー">
     </form>
    @endif
    @endif
    
    
    <div class="profile_image">
    @if($user->image !== '')
    <div class="image" style="background-image:url({{ \Storage::url($user->image) }})"></div>
    @else
    <div class="image" style="background-image:url({{ asset('images/no_image.png') }})"></div>
    @endif
    </dd>
    </div>
    
    <dd>{{ $user->profile }}</dd>
</dl>

@if($user->id === \Auth::user()->id)
<a href="{{ route('profile.edit',$user) }}">変更</a>
@endif

<div class="recipe_wrapper flex">
@forelse($recipes as $recipe)
    <a href="{{ route('recipes.show',$recipe) }}" class="recipe_card">
        <div class="recipe_title">
            <div class="recipe_content">
                {{ $recipe->name }}
                {{ $data }} 
                <div class="recipe_img">
                    @if($recipe->image !== '')
                     <a href="{{ route('recipes.show',$recipe) }}" class="image" style='background-image:url({{ \Storage::url($recipe->image) }})'>
                         
                     </a>
                    @else 
                     <div class="image" style='background-image:url({{ asset('images/no_image.png') }})'></div>
                     
                    @endif
                </div>
                
            </div>
            
        </div>
    </a>
    
    
@empty
<p>レシピがありません。</p>
<a>レシピを投稿してみよう</a>
@endforelse
</div>

@endsection