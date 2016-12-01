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

Route::get('/home', 'HomeController@index');

Route::get('/profiel', 'UserController@profiel');
Route::get('/editprofiel', 'UserController@editprofiel');
Route::post('/editprofiel', 'UserController@update');

Route::get('/overview', 'UserController@index');

Route::post('/profiel', 'UserController@update_avatar');

Route::get('/overview', 'UserController@index');
Route::get('/overview/{id}', 'UserController@show');
Route::get('/overview/{users}', 'UserController@show');
