@extends('layouts.2column')

@section('title',$title)

@section('content')
@section('main_content')
<div class="category_wrapper">{{ $category->name }}：{{ $category->recipes->count()}}件</div>
@forelse($category->recipes as $recipe)
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
                            {{ $recipe->name }}By<a href="{{ route('user.show',$user) }}">{{ $recipe->user->name }}</a>
                    </div>
                        <span class="article_category">{{ $recipe->category->name }}</span>
                            <time class="article_date">{{ $data }}</time>
                            <ul class="material_list">
                            @foreach($recipe->materials as $material)
                            <li>{{ $material->name }}{{ $material->amount }}{{ $material->unit }}</li>
                            @endforeach
                            </ul>
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
@endsection

@section('sidebar')
  <div class="widget" style="margin-top:200px;">
        <span class="widget_title">人気レシピ</span>        
        <ul>
            
            <li></li>
            
        </ul>
    </div>

@endsection