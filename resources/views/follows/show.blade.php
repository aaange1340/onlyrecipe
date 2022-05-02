@extends('layouts.1column')
@section('title',$title)



<div class="title_wrapper"><h1>{{ $title }}</h1></div>
@section('main_content')

<ul class="follow_users">
    @forelse($follow_users as $follow_user)
        <li class="follow_user">
            @if($follow_user->image !== '')
                <a href="{{ route('user.show',$follow_user) }}"><img src="{{ asset('storage/' .$follow_user->image) }}"></a>
            @else
                <a href="{{ route('user.show',$follow_user) }}"><img src="{{ asset('images/no_image.png') }}"></a>
            @endif
            <br>
            {{ $follow_user->name }}
            <form method="post" action="{{ route('follows.destroy',$follow_user) }}" class="follow">
                @csrf
                @method('delete')
                <input type="submit" value="フォロー解除">
            </form>
        </li>
        
        @empty
            <li>フォローしているユーザーはいません</li>
            <a href="{{ route('recommend_user.index') }}">フォローする人を探そう</a>
        @endforelse
    
</ul>


@endsection