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

Route::middleware('auth:api')->get('/clickers', function (Request $request) {
    return $request->user();
});
    Route::get('clickers/get/{id}', 'ClickerController@getAllById');

    Route::post('clickers/create/{id}', 'ClickerController@create');

    Route::get('clickers/init/{id}', 'ClickerController@init');

    Route::post('clickers/{id}', 'ClickerController@update');

    Route::get('clickers/{id}', 'ClickerController@get');

    Route::post('clickers/delete/{id}', 'ClickerController@delete');

