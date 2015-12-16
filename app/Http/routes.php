<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'HomeController@index');

Route::get('home', 'HomeController@index');
Route::get('invoice/add', 'HomeController@invoice_add');
Route::post('invoice/save', 'HomeController@invoice_save');
Route::get('invoice/user/list', 'HomeController@invoice_user_list');
Route::get('invoice/checked/user/{id}', 'HomeController@invoice_checked_user');
Route::get('invoice/pending/user/{id}', 'HomeController@invoice_pending_user');
Route::get('invoice/pending/act/{id}', 'HomeController@invoice_pending_act');
Route::post('invoice/pending/user/save', 'HomeController@invoice_pending_user_save');
Route::post('invoice/pending/act/save', 'HomeController@invoice_pending_act_save');
Route::get('invoice/pending/user/checked/{id}', 'HomeController@invoice_pending_user_checked');
Route::get('invoice/act/list', 'HomeController@invoice_act_list');
Route::get('invoice/pending/list', 'HomeController@invoice_pending_list');
Route::get('invoice/checked/act/{id}', 'HomeController@invoice_checked_act');
Route::get('invoice/fa/list', 'HomeController@invoice_fa_list');
Route::get('invoice/checked/fa/{id}', 'HomeController@invoice_checked_fa');
Route::get('invoice/fa/rtp_list', 'HomeController@invoice_rtp_list');
Route::get('master/upload', 'HomeController@upload_master');
Route::post('master/upload','HomeController@Upload');

Route::get('user/create', 'WelcomeController@user_create');
Route::post('user/save_create', 'WelcomeController@save_create');
Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
