@extends('layouts.1column')

@section('title',$title)



<div class="title_wrapper"><h1>{{ $title }}</h1></div>
@section('main_content')

<ul class="follow_users">
    @forelse($followers as $follower)
        <li class="follow_user">
            @if($follower->image !== '')
                <a href="{{ route('user.show',$follower) }}"><img src="{{ asset('storage/' .$follower->image) }}"></a>
            @else
                <a href="{{ route('user.show',$follower) }}"><img src="{{ asset('images/no_image.png') }}"></a>
            @endif
            <br>
            {{ $follower->name }}
            <form method="post" action="{{ route('follows.destroy',$follower) }}" class="follow">
                @csrf
                @method('delete')
                <input type="submit" value="フォロー解除">
            </form>
        </li>
        
        @empty
            <li>フォローしているユーザーはいません</li>
            <a href="">フォローする人を探そう</a>
        @endforelse
    
</ul>
@endsection
