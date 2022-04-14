@extends('layouts.default')

@section('header')

<header>
    <ul class="top_menu">
        <li><a href="{{ route('register') }}">新規登録</a></li>
        <li><a href="{{ route('login') }}">ログイン</a></li>
    </ul>
    
</header>



@endsection
