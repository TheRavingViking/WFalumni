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

<<<<<<< HEAD
Route::get('/page', function () {
    return view('page');
});
=======
Route::get('/overview', 'overview@fetchall');
>>>>>>> 67314c5382d17bd783bf32d0b4791cfc0cf6444c
