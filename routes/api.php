<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/people', 'UserController@users');
Route::get('/people/{id}', 'UserController@get');
Route::post('/people', 'UserController@insert');
Route::put('/people/{id}', 'UserController@update');
Route::delete('/people/{id}', 'UserController@delete');
