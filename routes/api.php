<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


//Route::get({uri: '/secrets', action:'SecretController@index'})

Route::group(['prefix' => 'v1', 'middleware' => 'auth:api'], function(){
    Route::get('/user/setup-intent', 'UserController@getSetupIntent');
});

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
