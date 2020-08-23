<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'v1', 'middleware' => 'auth:api'], function(){
    Route::get('/user/setup-intent', 'UserController@getSetupIntent');
});

Route::apiResource('/question', 'QuestionController');
Route::apiResource('/category', 'CategoryController');
Route::apiResource('/question/{question}/reply', 'ReplyController');
Route::post('/reply/{reply}/like', 'LikeController@LikeIt');
Route::delete('/reply/{reply}/like', 'LikeController@UnlikeIt');
