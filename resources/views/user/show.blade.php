@extends('layouts.2column')

@section('title',$title)


<div class="user_profile">
    
<h1>{{ $title }}</h1>

<dl>
    <dt>ユーザー名:{{ $user->name }}</dt><a href="{{ route('follows.show',$user) }}">フォロー：{{ $user->follows->count() }}</a><a href="{{ route('followers.followerShow',$user) }}">フォロワー：{{ $user->followers->count() }}</a>
    <br>
    @if($user->follows->count() < 1 && $user->id === \Auth::user()->id)
    <a href="{{ route('recommend_user.index') }}">フォローする人を探そう</a>
    @endif
    <dd><div class="profile_image">
    @if($user->image !== '')
    <div class="profile_image" style="background-image:url({{ \Storage::url($user->image) }})"></div>
    @else
    <div class="profile_image" style="background-image:url({{ asset('images/no_image.png') }})"></div>
    @endif
    </div></dd>
    @if($user->id != \Auth::user()->id)
    @if(Auth::user()->isFollowing($user))
     <form method="post" action="{{ route('follows.destroy',$user) }}" class="follow">
        @csrf
        @method('delete')
        <input class="button" type="submit" value="フォロー解除">
     </form>
    @else
     <form method="post" action="{{ route('follows.store') }}" class="follow">
        @csrf
        <input type="hidden" name="follow_id" value="{{ $user->id }}">
        <input class="button" type="submit" value="フォロー">
     </form>
    @endif
    @endif
    
    <dt>自己紹介文</dt>
    <dd>{{ $user->profile }}</dd>
</dl>
@if($user->id === \Auth::user()->id)
<a href="{{ route('profile.edit',$user) }}">変更</a>
@endif

</div>


@section('main_content')

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
{{ $recipes->links() }}
</div>
@endsection



@section('sidebar')
 
    
    
    <div class="widget">
        <span class="widget_title">人気レシピ</span>        
        <ul>
            
            <li></li>
            
        </ul>
    </div>

@endsection

