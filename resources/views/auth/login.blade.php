@extends('layouts.not_logged_in')

@section('title','ログイン画面')

@section('content')
     <div class="top_view" style='background-image:url({{ asset('images/recipe_main.jpg') }})'>
         <div class="login_container">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group">
                    <label for="name">
                        ユーザー名orメールアドレス：
                        <div>
                            <input class="form-control" type="name" name="name">
                        </div>
                    </label>
                </div>
                
                <div class="form-group">
                    <label for="password">
                        パスワード：
                        <div>
                            <input class="form-control" type="password" name="password">
                        </div>
                    </label>
                </div>
                
                <input class="button" type="submit" value="ログイン">
            </form>
         </div>
         
     </div>
@endsection