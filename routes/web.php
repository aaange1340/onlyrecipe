<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();
//TOP
Route::get('/','RecipeController@index')->name('top');

Route::resource('recipes','RecipeController');

Route::resource('likes','LikeController')->only([
    'index','store','destroy'    
]);
//プロフィール関連
Route::get('/profile/{user}/edit','UserController@edit')->name('profile.edit');
Route::patch('/profile/{user}','UserController@update')->name('profile.update');

Route::get('/users/{user}','UserController@show')->name('user.show');

//フォロー関連
Route::resource('follows','FollowController')->only([
    'index','store','destroy'
]);
Route::get('/follower','FollowController@followerIndex');

//いいね関連
Route::patch('/recipes/{recipe}/toggle_like','RecipeController@toggleLike')->name('recipes.toggle_like');

//コメント
Route::resource('comments','CommentController')->only([
    'store','destroy'
]);
Route::get('/comments/{recipe}','CommentController@create')->name('comments.create');
