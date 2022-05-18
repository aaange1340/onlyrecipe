@extends('layouts.1column')

@section('title',$title)


<div class="user_profile">
    
<h1>{{ $title }}</h1>

<dl>
    <dt>ユーザー名:{{ $user->name }}    レシピ数：{{$user->recipes->count()}}</dt><a class="mr-5" href="{{ route('follows.show',$user) }}">フォロー：{{ $user->follows->count() }}</a><a href="{{ route('followers.followerShow',$user) }}">フォロワー：{{ $user->followers->count() }}</a>
    <br>
    @if($user->follows->count() < 1 && $user->id === \Auth::user()->id)
    <a href="{{ route('recommend_user.index') }}">フォローする人を探そう!!</a>
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
@forelse($recipes as $recipe)
        <div class="recipe_container">
            
            <div class="recipe_flex">
                <figure class="recipe_image">
                    @if($recipe->image !== '')
                     <a href="{{ route('recipes.show',$recipe) }}" class="image" style='background-image:url({{ \Storage::url($recipe->image) }})'>
                     <p>詳細</p>
                     </a>
                    @else 
                     <a href="{{ route('recipes.show',$recipe) }}">
                     <div class="image" style='background-image:url({{ asset('images/no_image.png') }})'></div>
                     <p>詳細</p>
                     </a>
                     
                    @endif
                </figure>
                
                <div class="article_info">
                    <div class="recipe_title">
                            {{ $recipe->name }}By<a href="{{ route('user.show',$recipe->user->id) }}">{{ $recipe->user->name }}</a>
                    </div>
                        <span class="article_category">{{ $recipe->category->name }}</span>
                            <time class="article_date">{{ $recipe->created_at->format('Y年m月d日') }}</time>
                            <ul class="material_list">
                            @foreach($recipe->materials as $material)
                            <li>{{ $material->name }}{{ $material->amount }}{{ $material->unit }}</li>
                            @endforeach
                            </ul>
                            <a class="like_button">{!! $recipe->isLikedBy(Auth::user()) ? '<i class="fa-solid fa-heart-circle-check"></i>':'<i class="fa-solid fa-thumbs-up"></i>' !!} 
                            </a>
                            <form method="post" action="{{ route('recipes.toggle_like',$recipe) }}" class="like">
                             @csrf
                             @method('patch')
                            </form>
            
                            <a href="{{ route('comments.create',$recipe) }}"><i class="fa-solid fa-comment"></i></a>
                            
                            
                </div>
                
            </div>
    
        </div>

@empty
<p>レシピがありません。</p>
<div class="recipe_create">
    <a href="{{ route('recipes.create') }}"><i class="fa-solid fa-feather-pointed fa-3x"></i>レシピを投稿してみよう！</a>
    </div>

@endforelse
{{ $recipes->links() }}
</div>
@endsection



