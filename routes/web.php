<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/confirmation/{code}', 'Auth\RegisterController@confirm');
Route::post('/sendconfirmationemail', 'Auth\RegisterController@resendConfirmation');

Route::group(['middleware'=> 'auth'], function(){
  Route::get('/home', 'HomeController@index');
  Route::post('/emailsuggestion', 'ShareLink@recipientSuggestion');
  Route::post('/share', 'ShareLink@send');
  Route::any('/extracthtml', 'ShareLink@htmlcontents'); //Change it to appropiate later
	//Route::get('/inbox', 'InboxController@messages');
});
