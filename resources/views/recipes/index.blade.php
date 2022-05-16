@extends('layouts.2column')

@section('title',$title)


<div class="top_view" style='background-image:url({{ asset('images/dish.jpg') }})'>
    <div class="top_content">
        
    <p class="top_title">口福から始まる幸福を</p>
    <p>レシピを通して世界中で繋がれる<span class="page_title">「ONLY RECIPE」</span></p>
    </div>
</div>

<div class="title_wrapper">
<h1>{{ $title }}</h1>
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
                            <time class="article_date">{{ $data }}</time>
                            <ul class="material_list">
                            @foreach($recipe->materials as $material)
                            <li>{{ $material->name }}{{ $material->amount }}{{ $material->unit }}</li>
                            @endforeach
                            </ul>
                            <a class="like_button">{!! $recipe->isLikedBy(Auth::user()) ? '<i class="fa-solid fa-heart-circle-check"></i>':'<i class="fa-solid fa-thumbs-up"></i>' !!} 
                            </a>
                            @if($recipe->likes->count() !== 0)
                            <span>{{ $recipe->likes->count() }}</span>
                            @endif
                            <form method="post" action="{{ route('recipes.toggle_like',$recipe) }}" class="like">
                             @csrf
                             @method('patch')
                            </form>
            
                            <a href="{{ route('comments.create',$recipe) }}"><i class="fa-brands fa-quora"></i></a>{{ $recipe->comments->count() }}
                            
                            
                </div>
                
            </div>
    
        </div>
    
    
@empty
<p>レシピがありません。</p>

@endforelse
@endsection


@section('sidebar')
    <div class="recipe_create">
    <a href="{{ route('recipes.create') }}"><i class="fa-solid fa-feather-pointed fa-3x"></i>レシピ追加</a>
    </div>

    <div class="search">
        <form class="form-group" method="GET">
            @csrf
            <input class="form-control" type="search" placeholder="キーワード" name="search" value="@if(isset($search)) {{ $search }} @endif" style="margin-bottom:20px;">
            <input class="button" type="submit" value="検索">
        </form>
    </div>
    
    <div class="widget">
        <span class="widget_title">CATEGORY</span>
        <ul>
            @foreach($categories as $category)
            <li><a href="{{ route('category.index',$category) }}">{{ $category->name }}</a><span>{{ $category->recipes->count() }}</span></li>
            @endforeach
        </ul>
    </div>
    
    <div class="widget">
        <span class="widget_title">RANKING</span>        
        <ul class="ranking">
            @foreach($like_recipes as $like_recipe)
            <li><a href="{{ route('recipes.show',$recipe) }}">{{ $like_recipe->name }}By{{ $like_recipe->user->name }}<span>{{ $like_recipe->likedUsers->count() }}</span></a></li>
            @endforeach
        </ul>
    </div>
</aside>


</div>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
  /* global $ */
  $('.like_button').on('click', (event) => {
      $(event.currentTarget).next().submit();
  })
</script>
@endsection

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
        <a href="#" class="to-top"><img src="../images/totop.png" alt="ページのトップへ移動"></a>
    </div>
</div>


</footer>
@endsection