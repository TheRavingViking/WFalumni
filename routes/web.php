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
Route::get('/mail', 'MailController@index');
Route::get('/profiel', 'UserController@profiel');
Route::post('/profiel', 'UserController@update');
Route::post('/profiel/opleiding', 'UserController@createOpleiding');
Route::post('/profiel/opleiding/delete', 'UserController@deleteOpleiding');
Route::post('/profiel/bedrijf', 'UserController@createBedrijf');
Route::post('/profiel/bedrijf/delete', 'UserController@deleteBedrijf');
Route::post('/profiel/woonplaats', 'UserController@createWoonplaats');
Route::post('/profiel/woonplaats/delete', 'UserController@deleteWoonplaats');

Route::get('/overview', 'UserController@index');
Route::get('/overview', 'UserController@search');
Route::post('/overview', 'UserController@MassSoftDelete');
Route::get('/profiel/{user}', 'UserController@show');
Route::post('/profiel/delete', 'UserController@SoftDelete');
