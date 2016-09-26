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

Route::resource('/home', 'HomeController');

Route::resource('Event', 'EventController');
Route::get('Four', 'FoursquareController@getPage');

Route::get('Events', 'EventController@index');
Route::get('Events/{venue}/{artist}', 'EventController@show');
Route::resource('Blog', 'Blog\PostController');

Route::get('lastfm/{artist}', 'BandController@getPage', function () {
    return view('api.lastfm');
});
