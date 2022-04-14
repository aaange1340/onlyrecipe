@extends('layouts.logged_in')

@section('title',$title)

@section('content')

<h1>{{ $title }}</h1>

<form method="POST" action="{{ route('profile.update') }}">
    @csrf
    @method('PATCH')
    
    <div>
        <label>
            ユーザー名：
            <input type="text" name="{{ old('name',$user->name) }}">
        </label>
    </div>
    
    <div>
        <label>
            自己紹介文：
            <textarea name="profile">{{ old('profile',$user->profile) }}</textarea>
        </label>
    </div>
    
    
</form>

@endsection