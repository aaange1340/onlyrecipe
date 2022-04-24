@extends('layouts.logged_in')

@section('title',$title)

@section('content')
    <h1>{{ $title }}</h1>
    
    <ul class="">
    @forelse($like_recipes as $recipe)
        <li>
            @empty
        </li>
    </ul>
@endforelse
@endsection