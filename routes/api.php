<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


// Send reset password mail
Route::post('reset-password', 'AuthController@sendPasswordResetLink');

// handle reset password form process
Route::post('reset/password', 'AuthController@callResetPassword');


Route::apiResource('/questions', 'QuestionController');
Route::apiResource('/category', 'CategoryController');
Route::apiResource('/question/{question}/reply', 'ReplyController');
Route::post('/like/', 'LikeController@LikeIt');
Route::delete('/dislike/', 'LikeController@UnlikeIt');

Route::post('notifications', 'NotificationController@index');
Route::post('markAsRead', 'NotificationController@markAsRead');
Route::post('deleteNotifications', 'NotificationController@deleteNotifications');


