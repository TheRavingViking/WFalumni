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
Route::post('/mail', function (\illuminate\Http\Request $request, \illuminate\Mail\Mailer $mailer){
    $mailer->to($request->input('Email'))->send(new \App\Mail\MailAll($request->input('users')));
return redirect()->back();});

Route::get('/profiel', 'UserController@profiel');
Route::post('/profiel', 'UserController@update');
//Route::post('/profiel', 'UserController@update_avatar');

Route::get('/overview', 'UserController@index');
Route::post('/overview', 'UserController@SoftDelete');
Route::get('/profiel/{user}', 'UserController@show');
//Route::post('/profiel', 'UserController@delete');
