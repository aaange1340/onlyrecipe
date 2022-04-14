@extends('layouts.logged_in')

@section('title',$title)

@section('content')

<h1>{{ $title }}</h1>

<dl>
    <dt>ユーザー名</dt>
    <dd>{{ $user->name }}
    @if($user->image !== '')
    <div class="image" style="background-image:url({{ \Storage::url($user->image) }})"></div>
    @else
    <div class="image" style="background-image:url({{ asset('images/no_image.png') }})"></div>
    @endif
    </dd>
    
    <dd>{{ $user->profile }}</dd>
</dl>

<a href="{{ route('profile.edit') }}">変更</a>


@endsection