<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/register','AuthApi@register');
Route::post('/login','AuthApi@login');

Route::group(['middleware'=>'auth:api'],function(){
Route::post('/feed/create','FeedApi@create');
Route::post('/comment/create','CommentApi@create');
Route::get('/comment','CommentApi@getcomment');
Route::delete('/comment/delete','CommentApi@deletecomment');
Route::post('/like/create','LikeApi@like');
Route::delete('/like/delete','LikeApi@dislike');

});
