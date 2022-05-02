@extends('layouts.2column')

@section('title',$title)

@section('main_content')
<div class="user_profile">
    
<h1>{{ $title }}</h1>

<dl>
    @forelse($recommended_users as $recommend_user)
    <dt>ユーザー名:{{ $recommend_user->name }}
     @if($recommend_user->id != \Auth::user()->id)
    @if(Auth::user()->isFollowing($recommend_user))
     <form method="post" action="{{ route('follows.destroy',$user) }}" class="follow">
        @csrf
        @method('delete')
        <input class="button" type="submit" value="フォロー解除">
     </form>
    @else
     <form method="post" action="{{ route('follows.store') }}" class="follow">
        @csrf
        <input type="hidden" name="follow_id" value="{{ $recommend_user->id }}">
        <input class="button" type="submit" value="フォロー">
     </form>
    @endif
    @endif
    </dt><a href="{{ route('follows.index') }}">フォロー：{{ $recommend_user->follows->count() }}</a><a href="{{ route('followers.index') }}">フォロワー：{{ $recommend_user->followers->count() }}</a>
    <br>
    @if($recommend_user->follows->count() < 1 && $recommend_user->id === \Auth::user()->id)
    <a href="{{ route('recommend_user.index') }}">フォローする人を探そう</a>
    @endif
    <dd><div class="profile_image">
    @if($recommend_user->image !== '')
    <div class="profile_image" style="background-image:url({{ \Storage::url($recommend_user->image) }})"></div>
    @else
    <div class="profile_image" style="background-image:url({{ asset('images/no_image.png') }})"></div>
    @endif
    </div></dd>
    
    <dt>自己紹介文</dt>
    <dd>{{ $recommend_user->profile }}</dd>
</dl>
@if($recommend_user->id === \Auth::user()->id)
<a href="{{ route('profile.edit',$user) }}">変更</a>
@endif


@empty
<p>おすすめユーザーはいません</p>
@endforelse
</div>
@endsection


@section('sidebar')
<div class="widget" style="margin-top:200px;">
        <span class="widget_title">人気レシピ</span>        
        <ul>
            
            <li></li>
            
        </ul>
    </div>

@endsection