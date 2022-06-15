@extends('layouts.default')

@section('title','ユーザー登録画面')

@section('content')
 <div class="register_view" style='background-image:url({{ asset('images/recipe_main.jpg') }})'>
    <div class="login_container">

    
        
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="form-group">
            <label class="required">
                ユーザー名
                <input class="form-control" type="text" name="name">
            </label>
        </div>
        
        <div class="form-group">
            <label class="required">
                国籍
                <select class="form-control" name="national_id">
                    <option disabled style='display:none;' @if(empty($user->national_id)) selected @endif>選択してください 
                    </option>
                @foreach(config('country') as $key => $value)
                    <option value="{{ $key }}">{{ $value }}</option>
                @endforeach
                </select>
            </label>
        </div>
        
        <div class="form-group">
            <label class="required">
                メールアドレス
                <input class="form-control" type="email" name="email">
            </label>
        </div>
        
        <div class="form-group">
            <label class="required">
                パスワード(半角英数字8文字以上)
                <input class="form-control" type="password" id="password" name="password">
            </label>
                <button id="btn_passview">表示</button>
        </div>
        
        <div class="form-group">
            <label class="required">
                パスワード（確認用）
                <input class="form-control" type="password" name="password_confirmation">
            </label>
        </div>
        
        <div class="register_button">
            <input class="button" type="submit" value="登録">
        </div>
        <a href="{{ route('login') }}">ログインはこちらから</a>
        
    </form>
    </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
    
    window.addEventListener('DOMContentLoaded',function(){
        
        let btn_passview = document.getElementById("btn_passview");
        let password = document.getElementById("password");
        
        btn_passview.addEventListener("click",(e)=>{
           e.preventDefault();
           
           if(password.type === 'password'){
            password.type = 'text';
            btn_passview.textContent = '非表示';
           } else{
           
           password.type = 'password';
           btn_passview.textContent = '表示';
           }
        
    });
            
        });
    </script>
    @endsection