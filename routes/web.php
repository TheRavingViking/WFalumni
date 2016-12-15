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
    Alert::info('Wookies', 'Welkom bij WFAlumni!');
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->middleware('auth');

Route::get('/mail', 'MailController@index')->middleware('auth');

Route::get('/profiel', 'UserController@profiel')->middleware('auth');
Route::get('/profiel/{user}', 'UserController@show')->middleware('auth');
Route::post('/profiel/delete', 'UserController@SoftDelete')->middleware('auth');

Route::post('/profiel', 'UserController@update')->middleware('auth');

Route::post('/profiel/opleiding', 'UserController@createOpleiding')->middleware('auth');
Route::post('/profiel/opleiding/delete', 'UserController@deleteOpleiding')->middleware('auth');

Route::post('/profiel/bedrijf', 'UserController@createBedrijf')->middleware('auth');
Route::post('/profiel/bedrijf/delete', 'UserController@deleteBedrijf')->middleware('auth');

Route::post('/profiel/woonplaats', 'UserController@createWoonplaats')->middleware('auth');
Route::post('/profiel/woonplaats/delete', 'UserController@deleteWoonplaats')->middleware('auth');

Route::get('/overview', 'UserController@index')->middleware('auth');
Route::get('overview/search','UserController@search')->middleware('auth');
Route::get('overview/filter','UserController@filter')->middleware('auth');
Route::post('/overview', 'UserController@MassSoftDelete')->middleware('auth');

Route::get('/mijnopleiding', 'UserController@mijnOpleiding')->middleware('auth');
Route::get('/mijnopleiding/search', 'UserController@mijnOpleidingSearch')->middleware('auth');

Route::post('/personeelProfiel/store', 'PersoneelController@update')->middleware('auth');
Route::post('/personeelProfiel/delete', 'PersoneelController@SoftDelete')->middleware('auth');

Route::get('/personeelOverview', 'PersoneelController@index');
