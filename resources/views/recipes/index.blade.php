@extends('layouts.logged_in')

@section('title',$title)

@section('content')
<h1>{{ $title }}</h1>



<a href="{{ route('recipes.create') }}">レシピ追加</a>

<div class="recipe_wrapper flex">
@forelse($recipes as $recipe)
    <a href="{{ route('recipes.show',$recipe) }}" class="recipe_card">
        <div class="recipe_title">
            <div class="recipe_content">
                {{ $recipe->name }}
                {{ $data }}
                <div class="recipe_img">
                    @if($recipe->image !== '')
                     <a href="{{ route('recipes.show',$recipe) }}" class="image" style='background-image:url({{ \Storage::url($recipe->image) }})'>
                         
                     </a>
                    @else 
                     <div class="image" style='background-image:url({{ asset('images/no_image.png') }})'></div>
                     
                    @endif
                </div>
                
            </div>
            
        </div>
    </a>
    
    
@empty
<p>レシピがありません。</p>
@endforelse
</div>


@endsection