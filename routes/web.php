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
    return view('stuff.jQ');
});
Route::get('/', 'UserController@index');

Route::get('/startpage/{id}', 'UserController@sessionIndex');

Route::get('/register', 'UserController@register')->name('register');
Route::post('/register', 'UserController@store');

Route::get('/login', 'UserController@login')->name('login');
Route::post('/login', 'UserController@loginRequest');
Route::get('/login/{id}', 'UserController@show');

Route::get('/logout/{id}', 'UserController@logout')->name('logout');

Route::get('/support/{id}', 'TicketController@support')->name('support');

Route::get('/game/{id}', 'ClickerController@index')->name('game');
Route::post('/game/{id}', 'ClickerController@getAllById');

Route::get('/home', 'HomeController@index')->name('home');
