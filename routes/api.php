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

Route::get('clickers/init/{id}', 'ClickerController@init');
Route::post('clickers/create/{id}', 'ClickerController@create');
Route::post('clickers/{id}', 'ClickerController@update');
Route::post('clickers/delete/{id}', 'ClickerController@delete');

Route::get('clickers/{id}', 'ClickerController@get');
Route::get('clickers/get/{id}', 'ClickerController@getAllById');


Route::get('tickets/{id}', 'TicketController@index')->name('tickets');
Route::post('tickets/{id}', 'TicketController@store');
Route::get('tickets/list/{id}', 'TicketController@getAll')->name('ticketList');
Route::get('ticket/view/{id}', 'TicketController@show')->name('ticketView');
Route::get('ticket/get/{id}', 'TicketController@get');
Route::get('tickets/update/{id}', 'TicketController@update');
Route::post('tickets/delete/{id}', 'TicketController@delete');


