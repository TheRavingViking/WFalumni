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

Auth::routes();

Route::get('/', 'UserController@redirectCheck');

//mail
Route::get('/mail', 'MailController@index')->middleware('auth');
Route::post('/mail', 'MailController@send')->middleware('auth');
//profiel
Route::get('/profiel', 'UserController@profiel')->middleware('auth');
Route::get('/profiel/{user}', 'UserController@show')->middleware('auth');
Route::post('/profiel/delete', 'UserController@SoftDelete')->middleware('auth');
//addUser
Route::get('/addUser', 'UserController@addUserIndex')->middleware('admin');
Route::post('/addUser', 'UserController@addUser')->middleware('admin');
//SetPass
Route::get('/setPass', 'UserController@setPassIndex')->middleware('auth');
Route::post('/setPass', 'UserController@setPass')->middleware('auth');
//profiel
Route::post('/profiel', 'UserController@update')->middleware('auth');
//profiel->opleiding
Route::post('/profiel/opleiding', 'UserController@createOpleiding')->middleware('auth');
Route::post('/profiel/opleiding/delete', 'UserController@deleteOpleiding')->middleware('auth');
//profiel->bedrijf
Route::post('/profiel/bedrijf', 'UserController@createBedrijf')->middleware('auth');
Route::post('/profiel/bedrijf/delete', 'UserController@deleteBedrijf')->middleware('auth');
//profiel->woonplaats
Route::post('/profiel/woonplaats', 'UserController@createWoonplaats')->middleware('auth');
Route::post('/profiel/woonplaats/delete', 'UserController@deleteWoonplaats')->middleware('auth');
//profiel->overview
Route::get('/overview', 'UserController@index')->middleware('admin');
Route::get('overview/search', 'UserController@search')->middleware('admin');
Route::get('overview/filter', 'UserController@filter')->middleware('admin');
Route::post('/overview', 'UserController@MassSoftDelete')->middleware('admin');
//Mijnopleiding
Route::get('/mijnopleiding', 'UserController@mijnOpleiding')->middleware('auth');
Route::get('/mijnopleiding/search', 'UserController@mijnOpleidingSearch')->middleware('auth');
Route::get('/mijnopleiding/filter', 'UserController@mijnOpleidingFilter')->middleware('auth');
//Adminopleidingen
Route::get('/adminOpleidingen', 'AdminController@adminOpleidingen')->middleware('admin');
Route::post('/adminOpleidingen/richting', 'AdminController@createRichting')->middleware('admin');
Route::post('/adminOpleidingen/richtingEdit', 'AdminController@updateRichting')->middleware('admin');
Route::post('/adminOpleidingen/opleiding', 'AdminController@createOpleiding')->middleware('admin');
Route::post('/adminOpleidingen/opleidingEdit', 'AdminController@updateOpleiding')->middleware('admin');
Route::post('/adminOpleidingen/specialisatie', 'AdminController@createSpecialisatie')->middleware('admin');
Route::post('/adminOpleidingen/specialisatieEdit', 'AdminController@updateSpecialisatie')->middleware('admin');
//Admin bevoegdheid
Route::get('/admin', 'AdminController@index')->middleware('admin');
Route::get('/admin/search', 'AdminController@search')->middleware('admin');
Route::Post('/admin/assign', ['as' => 'admin.assign', 'uses' => 'AdminController@AdminAssign'])->middleware('admin'); //<-admin.assign rename, Laurens
//Admindashboard
Route::get('/dashboard', 'AdminController@dashboard')->middleware('opladmin');
Route::get('/dashboard/filter', 'AdminController@dashboardFilter')->middleware('opladmin');
Route::get('/geochart', 'AdminController@GeoChart')->middleware('opladmin');
Route::get('/geochart/filter', 'AdminController@GeoChartFilter')->middleware('opladmin');
//Comments
Route::get('/comments', 'CommentController@index')->middleware('opladmin');
Route::post('/addComment', 'CommentController@insertComment')->middleware('opladmin');
Route::post('/deleteComment', 'CommentController@deleteComment')->middleware('opladmin');

//Dropdowns
Route::get('/dropdown', 'UserController@dropdown')->middleware('auth');
Route::get('/bevoegdheid', 'DropdownController@afdeling')->middleware('auth');
route::get('/richtingen', 'DropdownController@opleidingen')->middleware('auth');
route::get('/opleidingen', 'DropdownController@specialisaties')->middleware('auth');

\Debugbar::enable(); //<-- Toont debugbar, Laurens, !!!! enable of disable!!!!

