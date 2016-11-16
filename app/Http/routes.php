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
Route::get('invoice/user/check', 'HomeController@invoice_user_check');
Route::get('invoice/checked/user/{id}', 'HomeController@invoice_checked_user');
Route::get('invoice/pending/user/{id}', 'HomeController@invoice_pending_user');
Route::get('invoice/pending/act/{id}', 'HomeController@invoice_pending_act');
Route::post('invoice/pending/user/save', 'HomeController@invoice_pending_user_save');
Route::post('invoice/pending/act/save', 'HomeController@invoice_pending_act_save');
Route::get('invoice/pending/user/checked/{id}', 'HomeController@invoice_pending_user_checked');
Route::get('invoice/act/list', 'HomeController@invoice_act_list');
Route::get('invoice/act/approve/list', 'HomeController@invoice_act_approve_list');
Route::get('invoice/act/reject/list', 'HomeController@invoice_act_reject_list');
Route::get('invoice/pending/list', 'HomeController@invoice_pending_list');
Route::get('invoice/checked/act/{id}', 'HomeController@invoice_checked_act');
Route::get('invoice/fa/list', 'HomeController@invoice_fa_list');
Route::get('invoice/checked/fa/{id}', 'HomeController@invoice_checked_fa');
Route::get('invoice/finish/fa/{id}', 'HomeController@invoice_finish_fa');
Route::get('invoice/fa/rtp_list', 'HomeController@invoice_rtp_list');
Route::get('invoice/fa/finish/list', 'HomeController@invoice_fa_finish_list');
Route::get('invoice/rtp', 'HomeController@invoice_rtp_list');
Route::get('invoice/op', 'HomeController@invoice_op_list');
Route::get('master/upload', 'HomeController@upload_master');
Route::post('master/upload','HomeController@upload');
Route::get('invoice/rtp/user', 'HomeController@invoice_rtp_user');
Route::get('invoice/op/user', 'HomeController@invoice_op_user');
Route::get('invoice/delete/{id}', 'HomeController@invoice_delete');
Route::get('invoice/detail/{id}', 'HomeController@invoice_detail');
Route::get('invoice/reject/user/{id}', 'HomeController@invoice_reject_user');
Route::get('invoice/reject/fa/{id}', 'HomeController@invoice_reject_fa');
Route::get('invoice/update/{id}', 'HomeController@invoice_update');
Route::post('invoice/update/save', 'HomeController@invoice_update_save');
Route::get('invoice/approval/detail/{id}', 'HomeController@invoice_approval_detail');

Route::get('user/create', 'HomeController@user_create');
Route::get('edit_password', 'HomeController@edit_password');
Route::post('save_edit_password', 'HomeController@save_edit_password');
Route::get('user/view', 'HomeController@user_view');
Route::post('user/save_create', 'HomeController@save_create');
Route::get('user/edit/{id}', 'HomeController@user_edit');
Route::get('user/delete/{id}', 'HomeController@user_delete');
Route::get('user/reset/{id}', 'HomeController@user_reset');
Route::post('user/save_edit', 'HomeController@save_edit');

Route::get('stock/view_area','StockController@view_area');
Route::post('stock/save_area','StockController@save_area');
Route::get('stock/edit_area/{id}', 'StockController@edit_area');
Route::post('stock/save_edit_area', 'StockController@save_edit_area');
Route::get('stock/delete_area/{id}', 'StockController@delete_area');
Route::post('stock/view_area', 'StockController@m_area_import');

Route::get('normalize/transaction','StockController@normalize_transaction');

Route::get('stock/view_part','StockController@view_part');
Route::post('stock/save_part','StockController@save_part');
Route::get('stock/edit_part/{id}', 'StockController@edit_part');
Route::POST('stock/save_edit_part', 'StockController@save_edit_part');
Route::get('stock/delete_part/{id}', 'StockController@delete_part');
Route::post('stock/view_part', 'StockController@m_part_import');

Route::get('stock/view_transaction','StockController@view_transaction');
Route::post('stock/view_list','StockController@view_list');
Route::get('stock/view_list/{id}','StockController@view_list3');
Route::get('stock/view_list/2/{id}','StockController@view_list2');

Route::get('stock/input_transaction/{id}','StockController@input_transaction');
Route::post('stock/save_transaction','StockController@save_transaction');


Route::get('stock/print_report','StockController@print_report');
Route::post('stock/print_result','StockController@print_result');
Route::get('stock/print_report_plant','StockController@print_report_plant');
Route::post('stock/print_plant_result','StockController@print_plant_result');
Route::get('stock/print_master_part','StockController@print_master_part');

Route::get('data','HomeController@data');
Route::get('data_user','HomeController@data_user');
Route::post('import/vendor','HomeController@import_vendor');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
