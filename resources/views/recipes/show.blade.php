@extends('layouts.1column')

@section('title',$title)

@section('main_content')

<div class="title_wrapper"><h1>{{ $title }}</h1></div>

<div class="flex">
<div class="container">

<h2>{{ $recipe->name }}</h2>
<div class="recipe_flex">
<div class="recipe_image">
    {{ $recipe->category->name }}
@if($recipe->image !== '' )
    <a href="{{ route('recipes.show',$recipe) }}" class="image" style="background-image:url({{ \Storage::url($recipe->image) }})">
    </a>
@else
    <div class="image" style="background-image:url({{ asset('images/no_image.png') }})"></div>
@endif
</div>
    
<div class="recipe_
process">
    {{ $recipe->process }}
</div>
    
</div>
<a href="{{ route('recipes.edit',$recipe) }}">編集</a>
@if($user->id === $recipe->user->id)
    <form method="POST" action="{{ route('recipes.destroy',$recipe) }}">
        @csrf
        @method('delete')
        <input class="icon_button" type="submit" value=&#xf2ed; class="fas">
    </form>
@endif
   
    <div class="faqs">
                    <div class="faqs-inner inner">
                        <h2>Q&A</h2>
                        
                        
                        <div class="accordion-area">
                            
                            @forelse($recipe->comments as $comment)
                            <dl class="accordion-items">
                                <dt class="accordion-title"> 
                                    {{ $comment->body }}By{{$comment->user->name}}{{ $comment->created_at }}
                                    <span class="accordion-icon"><a href="{{ route('answers.create',$comment->id) }}"><i style="margin-left:20px;" class="fa-solid fa-reply"></i></a></span>
                                     @if($comment->user->id === $user->id)
                                        <form method="POST" action="{{ route('comments.destroy',$comment) }}">
                                            @csrf
                                            @method('delete')
                                            @if(\Auth::user()->id === $recipe->user->id)
                                            <input class="icon_button" type="submit" value=&#xf2ed; class="fas">
                                            @endif
                                        </form>
                                     @endif
                                </dt>
                                <dd class="accordion-body">
                                    @forelse($comment->answer as $answer)
                                   <div class="accordion-text">{{ $answer->body}}By{{ $answer->user->name }}:{{ $answer->created_at}}</div>
                                    <!--<div class="accordion-text"></div>-->
                                    @empty
                                    <p>回答はありません。</p>
                                    @endforelse
                                </dd>
                            </dl>
                            @empty<p>質問はありません</p>
                            @endforelse
                    </div>
                        </div>
    </div>                         
</div>
</div>
</div>



@endsection