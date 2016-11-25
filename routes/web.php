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
Route::get('profiel', 'UserController@profiel');

Route::get('/page', function () {
    return view('page');
});

=======
Route::get('/overview', 'users@fetchall');
>>>>>>> 2d0241178d07a5402a2522dd633e77fd308a4610
