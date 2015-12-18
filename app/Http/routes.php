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
Route::get('invoice/input', 'HomeController@invoice_add');
Route::post('invoice/saving', 'HomeController@invoice_saving');
Route::get('invoice/user/list', 'HomeController@invoice_user_list');
Route::get('invoice/user/reject/list', 'HomeController@invoice_user_reject_list');
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
Route::get('invoice/rtp', 'HomeController@invoice_rtp_list');
Route::get('invoice/op', 'HomeController@invoice_op_list');
Route::get('master/upload', 'HomeController@upload_master');
Route::post('master/upload','HomeController@Upload');
Route::get('invoice/rtp/user', 'HomeController@invoice_rtp_user');
Route::get('invoice/op/user', 'HomeController@invoice_op_user');
Route::get('invoice/delete/{id}', 'HomeController@invoice_delete');
Route::get('invoice/detail/{id}', 'HomeController@invoice_detail');
Route::get('invoice/reject/user/{id}', 'HomeController@invoice_reject_user');
Route::get('invoice/reject/fa/{id}', 'HomeController@invoice_reject_fa');

Route::get('user/create', 'HomeController@user_create');
Route::get('user/view', 'HomeController@user_view');
Route::post('user/save_create', 'HomeController@save_create');
Route::get('user/edit/{id}', 'HomeController@user_edit');
Route::get('user/delete/{id}', 'HomeController@user_delete');
Route::get('user/reset/{id}', 'HomeController@user_reset');
Route::post('user/save_edit', 'HomeController@save_edit');
Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
