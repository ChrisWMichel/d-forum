<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//Route::group(['prefix' => 'v1', 'middleware' => 'auth:api'], function(){
//    Route::get('/user/setup-intent', 'UserController@getSetupIntent');
//});

Route::view('/', 'home');
Route::view('/{any}', 'home');
Route::view('/{any}/{any1}', 'home');


