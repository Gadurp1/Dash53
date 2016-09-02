<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::resource('/home', 'ClientsController');

Route::resource('Event', 'EventController');

Route::get('Events', 'EventController@index');
Route::get('Events/{venue}/{artist}', 'EventController@show');
Route::resource('Blogs', 'BlogController');
