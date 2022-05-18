@extends('layouts.default')
@section('header')
@auth
<header>
    <nav class="navbar navbar-expand-sm navbar-light bg-light fixed-top">
       
        <a href="{{ route('top') }}" class="navbar-brand">ONLY RECIPE</a>
    
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
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
            <a  href="{{ route('user.show',\Auth::user()) }}" class="nav-link">プロフィール</a>
        </li>
        <li class="nav-item">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <input class="button ml-2" type="submit" value="ログアウト">
            </form>
        </li>
        </ul>
        </div>
        </nav>
</header>
@endauth

@section('content')
<div class="container">
    <div class="row">
        
<div class=" recipe_wrapper col-12 col-md-9">
    <article class="article">
       @yield('main_content') 
        
    </article>
</div>
<aside class="aside col-12 col-md-3">
        
        @yield('sidebar')
        
</aside>
        
    </div>
</div>






@section('footer')
<footer class="footer">

<div class="footer-wrapper">

    <div class="footer-left">
        <div class="footer-icon">
            <a href="">
                <i class="fab fa-twitter fa-2x"></i>
            </a>
            <a href="">
                <i class="fab fa-facebook-square fa-2x"></i>
            </a>
        </div>

        <div class="footer-info">
            <p>サイトマップ</p>
            <p>個人情報保護方針</p>
            <p>プライバシーポリシー</p>
        </div>
    </div>



    <div class="footer-right">
<h3 class="footer-title">ONLY RECIPE
    <span class="footer-subtitle">&copy; Kazuyuki　Hashimoto page Sample.</span>
</h3>

    </div>


    <div class="page-top">
        <a href="#top" class="to-top"><img src="../images/totop.png" alt="ページのトップへ移動"></a>
    </div>
</div>


</footer>

@endsection


@endsection
@endsection