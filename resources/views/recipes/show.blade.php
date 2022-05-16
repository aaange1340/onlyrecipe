@extends('layouts.1column')

@section('title',$title)

@section('main_content')

<div class="title_wrapper"><h1>{{ $title }}</h1></div>

<ul class="flex">
<div class="container">

<h2>{{ $recipe->name }}</h2>
<div>
    {{ $recipe->category->name }}
@if($recipe->image !== '' )
    <a href="{{ route('recipes.show',$recipe) }}" class="image" style="background-image:url({{ \Storage::url($recipe->image) }})">
    </a>
@else
    <div class="image" style="background-image:url({{ asset('images/no_image.png') }})"></div>
@endif
<div>
<a href="{{ route('recipes.edit',$recipe) }}">編集</a>
    <form method="POST" action="{{ route('recipes.destroy',$recipe) }}">
        @csrf
        @method('delete')
        <input class="icon_button" type="submit" value=&#xf2ed; class="fas">
    </form>
    
    <ul>
        @forelse($recipe->comments as $comment)
        <li>コメント</li>
        <li>{{ $comment->user->name }}{{ $comment->created_at }}:{{ $comment->body }}</li>
        @if($comment->user->id === $user->id)
        <form method="POST" action="{{ route('comments.destroy',$comment) }}">
            @csrf
            @method('delete')
            @if(\Auth::user()->id === $recipe->user->id)
            <input class="icon_button" type="submit" value=&#xf2ed; class="fas">
            @endif
        </form>
        @endif
        @empty
        <li>コメントはありません</li>
        @endforelse
    </ul>
    <div class="faqs" id="faqs">
                    <div class="faqs-inner inner">
                        <h2>Q&A</h2>
                        
                        
                        <div class="accordion-area">
                            
                            @forelse($recipe->comments as $comment)
                            <dl class="accordion-items">
                                <dt class="accordion-title"> 
                                    {{ $comment->body }}By{{$comment->user->name}}{{ $comment->created_at }}
                                    <span class="accordion-icon"><a href="{{ route('answers.create',$comment->id) }}"><i style="margin-left:20px;" class="fa-solid fa-reply"></i></a></span>
                                    
                                </dt>
                                <dd class="accordion-body">
                                    <div class="accordion-text">{{ $answer }}</div>
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