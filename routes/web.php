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

/*Route::get('/', function () {
    return view('index');
});*/

Auth::routes();

Route::get('/jq', function () {
    return view('jQ');
});
Route::get('/register', 'UserController@register');

Route::post('/register', 'UserController@store');

Route::get('/login', 'UserController@login');

Route::post('/login', 'UserController@loginRequest');

Route::resource('/', 'UserController');

Route::get('/support', 'ClickerController@support');

Route::get('/game', 'ClickerController@index');

Route::post('/game', 'ClickerController@store');

