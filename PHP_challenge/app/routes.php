<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
//Home Page
Route::get('/', 'HomeController@home');


//Logout
Route::get('account/logout', 'UserController@logout');

//Registration
//registration form
Route::get('/account/create', 'UserController@create');
//store user data
Route::post('account/', array('before'=>'csrf', 'uses'=>'UserController@store'));

//Login
//login form
Route::get('/account/login', 'UserController@getLogin');
//check user authentication
Route::post('/account/login', array('before'=>'csrf', 'uses'=>'UserController@postLogin')); 

//Edit password
Route::get('/account/edit_password', 'UserController@editPassword');
Route::post('/account/edit_password', 'UserController@changePassword');