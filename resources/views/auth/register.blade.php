@extends('layouts.not_logged_in')

@section('title','ユーザー登録画面')

@section('content')
    <h1>新規登録</h1>
    
    <div class="container">
        
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="form-group">
            <label class="required">
                ユーザー名：
                <input class="form-control" type="text" name="name">
            </label>
        </div>
        
        <div class="form-group">
            <label class="required">
                メールアドレス：
                <input class="form-control" type="email" name="email">
            </label>
        </div>
        
        <div class="form-group">
            <label class="required">
                パスワード(半角英数字8文字以上)：
                <input class="form-control" type="password" id="password" name="password">
            </label>
                <button id="btn_passview">表示</button>
        </div>
        
        <div class="form-group">
            <label class="required">
                パスワード（確認用）：
                <input class="form-control" type="password" name="password_confirmation">
            </label>
        </div>
        
        <div>
            <input class="button" type="submit" value="登録">
        </div>
        
    </form>
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