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
//    Alert::info('Wookies', 'Welkom bij WFAlumni!');
    return view('auth/login');
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


//Route::get('/overview', 'UserController@index')->middleware('auth', 'admin');
//Route::get('overview/search','UserController@search')->middleware('auth', 'admin');
//Route::get('overview/filter','UserController@filter')->middleware('auth', 'admin');
//Route::post('/overview', 'UserController@MassSoftDelete')->middleware('auth', 'admin');

Route::get('/overview', 'UserController@index')->middleware('auth');
Route::get('overview/search','UserController@search')->middleware('auth');
Route::get('overview/filter','UserController@filter')->middleware('auth');
Route::post('/overview', 'UserController@MassSoftDelete')->middleware('auth');

Route::get('/mijnopleiding', 'UserController@mijnOpleiding')->middleware('auth');
Route::get('/mijnopleiding/search', 'UserController@mijnOpleidingSearch')->middleware('auth');


Route::get('/adminOpleidingen', 'AdminController@adminOpleidingen');
Route::post('/adminOpleidingen/richting', 'AdminController@createRichting');
Route::post('/adminOpleidingen/opleiding', 'AdminController@createOpleiding');
Route::post('/adminOpleidingen/specialisatie', 'AdminController@createSpecialisatie');
Route::get('/admin', 'AdminController@index')->middleware('auth');
Route::get('/dashboard', 'AdminController@dashboard')->middleware('auth');
Route::get('/dashboard/filter', 'AdminController@dashboardFilter')->middleware('auth');
Route::post('/admin/assign-roles', 'AdminController@postAdminAssignRoles')->name('admin.assign');
\Debugbar::disable(); //<-- Toont debugbar, Laurens, !!!! enable of disable!!!!