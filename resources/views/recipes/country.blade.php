@extends('layouts.1column')

@section('title',$title)

@section('main_content')
<div class="title_wrapper"><h1>{{ $title }}</h1></div>
@forelse($users as $user)
{{ $user->name }}
@empty
<p>その国のユーザーはいません</p>
@endforelse
@forelse($user->recipes as $recipe)
{{ $recipe->name }}
@empty
@endforelse



@endsection