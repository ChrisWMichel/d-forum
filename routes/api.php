<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


//Route::group(['prefix' => 'v1', 'middleware' => 'auth:api'], function(){
//    Route::get('/user/setup-intent', 'UserController@getSetupIntent');
//});
Auth::routes();
Route::middleware('auth:sanctum')->get('/user', function (Request $request) { //

    return $request->user();
});


Route::apiResource('/question', 'QuestionController');
Route::apiResource('/category', 'CategoryController');
Route::apiResource('/question/{question}/reply', 'ReplyController');
Route::post('/like/', 'LikeController@LikeIt');
Route::delete('/dislike/', 'LikeController@UnlikeIt');

Route::post('notifications', 'NotificationController@index');
Route::post('markAsRead', 'NotificationController@markAsRead');
Route::post('deleteNotifications', 'NotificationController@deleteNotifications');
