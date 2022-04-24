@extends('layouts.logged_in')

@section('title',$title)

@section('content')



<div class="title_wrapper">
<h1>{{ $title }}</h1>

<h2>おすすめユーザー</h2>
<ul class="recommended_users">
    @forelse($recommended_users as $recommend_user)
    <li><a href="{{ route('user.show',$recommend_user) }}">{{ $recommend_user->name }}</a></li>
    @empty
    <li>おすすめユーザーはいません</li>
    @endforelse
</ul>

<a href="{{ route('recipes.create') }}"><i class="fa-solid fa-feather-pointed fa-3x"></i>レシピ追加</a>
    
</div>

<div class="container">
    <div class="row">
        
<div class="recipe_wrapper col-9">

<article class="article">
    
@forelse($recipes as $recipe)
            <div class="recipe_flex">
                <figure>
                    @if($recipe->image !== '')
                     <a href="{{ route('recipes.show',$recipe) }}" class="image" style='background-image:url({{ \Storage::url($recipe->image) }})'>
                     </a>
                    @else 
                     <a href="{{ route('recipes.show',$recipe) }}">
                     <div class="image" style='background-image:url({{ asset('images/no_image.png') }})'></div>
                     </a>
                     
                    @endif
                </figure>
                
                <div class="article_info">
                    <div class="recipe_title">
                            {{ $recipe->name }}By{{ $recipe->user->name }}
                    </div>
                        <span class="article_category">{{ $recipe->category->name }}</span>
                            <time class="article_date">{{ $data }}</time>
                            <p>材料<br>材料材料</p>
                            <a class="like_button">{{ $recipe->isLikedBy(Auth::user()) ? 'いいね解除':'いいね' }} 
                            </a>
                            <form method="post" action="{{ route('recipes.toggle_like',$recipe) }}" class="like">
                             @csrf
                             @method('patch')
                            </form>
            
                            <a href="{{ route('comments.create',$recipe) }}"><i class="fa-solid fa-comment"></i></a>
                            
                            
                </div>
                
            </div>
    
    
    
@empty
<p>レシピがありません。</p>
@endforelse
</article>

</div>

<aside class="aside col-3">
    <div class="widget">
        <span class="widget_title">CATEGORY</span>
        <ul>
            @foreach($categories as $category)
            <li><a href="">{{ $category->name }}</a><span>{{ $category->recipes->count() }}</span></li>
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