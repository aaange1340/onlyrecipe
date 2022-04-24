@extends('layouts.logged_in')

@section('title',$title)

@section('content')

<h1>{{ $title }}</h1>

<form method="POST" action="{{ route('profile.update',$user) }}" enctype="multipart/form-data">
    @csrf
    @method('PATCH')
    
    @if($user->image !== '')
    <div class="image" style="background-image:url({{ \Storage::url($user->image) }})"></div>
    @else
    <div class="image" style="background-image:url({{ asset('images/no_image.png') }})"></div>
    @endif
    <div>
    <input type="file" name="image">
    </div>
    
    
    <div class="form-group">

        <label>
            ユーザー名：
            <input class="form-control" type="text" name="{{ old('name',$user->name) }}">
        </label>
    </div>
    
    <div class="form-group">
        <label>
            自己紹介文：
            <textarea class="form-control" name="profile">{{ old('profile',$user->profile) }}</textarea>
        </label>
    </div>
    
    <input type="submit" value="更新">
    
</form>

@endsection