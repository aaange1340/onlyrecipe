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

// Route::post('/recipes/{country_key}','RecipeController@country');

Route::resource('recipes','RecipeController');
Route::get('/recipes/{country_key}/country','RecipeController@country')->name('recipes.country');

Route::resource('likes','LikeController')->only([
    'index','store','destroy'    
]);
//プロフィール関連
Route::get('/profile/{user}/edit','UserController@edit')->name('profile.edit');
Route::patch('/profile/{user}','UserController@update')->name('profile.update');

Route::get('/users/{user}','UserController@show')->name('user.show');

//フォロー関連
Route::resource('follows','FollowController')->only([
    'index','store','destroy','show'
]);
Route::get('/followers/{followers}','FollowController@followerShow')->name('followers.followerShow');


Route::get('/follower','FollowController@followerIndex')->name('followers.index');

//いいね関連
Route::patch('/recipes/{recipe}/toggle_like','RecipeController@toggleLike')->name('recipes.toggle_like');

//コメント
Route::resource('comments','CommentController')->only([
    'store','destroy'
]);
Route::get('/comments/{recipe}','CommentController@create')->name('comments.create');

Route::get('/recommend','RecommendController@index')->name('recommend_user.index');

Route::get('/category/{category}','CategoryController@index')->name('category.index');

Route::resource('answers','AnswerController')->only([
  'index','store','destroy' 
]);
Route::get('/answers/{comment}','AnswerController@create')->name('answers.create');

Route::get('/answers','AnswerController@index')->name('answers.index');
Route::post('/answers','AnswerController@store')->name('answers.store');



Route::delete('answers/{answer}','AnswerController@destroy');

