@extends('layouts.default')


@section('header')
@auth
<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
       
        <a href="{{ route('top') }}" class="navbar-brand">ONLY RECIPE</a>
    
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navBar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
                
        <li class="nav-item">
            <a href="{{ route('recipes.index') }}" class="nav-link">
                Myレシピ
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('likes.index') }}" class="nav-link">      
                お気に入りレシピ
            </a>
        </li>
        <li class="nav-item">
            <a  href="{{ route('user.show',$user) }}" class="nav-link">プロフィール</a>
        </li>
        <li class="nav-item">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <input class="button" type="submit" value="ログアウト">
            </form>
        </li>
        </ul>
        </div>
        </nav>
</header>
@endauth
@endsection