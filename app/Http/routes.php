<?php

//cashier
Route::get('/', 'HomeController@index');
Route::post('invoice/saving', 'HomeController@invoice_saving');
Route::post('invoice/update', 'HomeController@invoice_update');
Route::get('invoice/rtp/user', 'HomeController@invoice_rtp');
Route::get('invoice/op/user', 'HomeController@invoice_op_user');
Route::get('invoice/reject/list', 'HomeController@list_invoice_reject');
Route::get('invoice/receive/op/{id}', 'HomeController@invoice_receive');
Route::get('master/upload', 'HomeController@upload_master');
Route::post('master/upload','HomeController@upload');
Route::get('invoice/update/{id}', 'HomeController@invoice_update');
Route::post('invoice/update/save', 'HomeController@invoice_update_save');
Route::get('invoice/delete/{id}', 'HomeController@invoice_delete');


//user
Route::get('invoice/user/list', 'UserInvoiceController@invoice_user_list');
Route::get('invoice/receive/user/{id}', 'UserInvoiceController@invoice_receive_user');
Route::get('invoice/receive/user', 'UserInvoiceController@list_invoice_receive_user');
Route::get('invoice/reject/user/{id}', 'UserInvoiceController@invoice_reject_user');
Route::get('invoice/send/user/{id}', 'UserInvoiceController@invoice_send_user');
Route::get('invoice/send/user/', 'UserInvoiceController@list_invoice_send_user');
Route::get('invoice/reject/user/', 'UserInvoiceController@list_invoice_reject_user');
Route::post('invoice/receive/user', 'UserInvoiceController@all_receive');
Route::post('invoice/send/user', 'UserInvoiceController@all_send');

//acc
Route::get('invoice/acc/list', 'AccInvoiceController@invoice_acc_list');
Route::get('invoice/receive/acc/{id}', 'AccInvoiceController@invoice_receive_acc');
Route::get('invoice/reject/acc/{id}', 'AccInvoiceController@invoice_reject_acc');
Route::get('invoice/receive/acc/', 'AccInvoiceController@list_invoice_receive_acc');
Route::get('invoice/send/acc/{id}', 'AccInvoiceController@invoice_send_acc');
Route::get('invoice/send/acc/fin/{id}', 'AccInvoiceController@invoice_send_acc_fin');
Route::get('invoice/send/acc/', 'AccInvoiceController@list_invoice_send_acc');
Route::get('invoice/reject/acc/', 'AccInvoiceController@list_invoice_reject_acc');

//tax
Route::get('invoice/tax/list', 'TaxInvoiceController@invoice_tax_list');
Route::get('invoice/receive/tax/{id}', 'TaxInvoiceController@invoice_receive_tax');
Route::get('invoice/reject/tax/{id}', 'TaxInvoiceController@invoice_reject_tax');
Route::get('invoice/receive/tax/', 'TaxInvoiceController@list_invoice_receive_tax');
Route::get('invoice/send/tax/{id}', 'TaxInvoiceController@invoice_send_tax');
Route::get('invoice/send/tax/', 'TaxInvoiceController@list_invoice_send_tax');
Route::get('invoice/reject/tax/', 'TaxInvoiceController@list_invoice_reject_tax');

//fin
Route::get('invoice/fin/list', 'FinInvoiceController@invoice_fin_list');
Route::get('invoice/receive/fin/{id}', 'FinInvoiceController@invoice_receive_fin');
Route::get('invoice/reject/fin/{id}', 'FinInvoiceController@invoice_reject_fin');
Route::get('invoice/receive/fin/', 'FinInvoiceController@list_invoice_receive_fin');
Route::get('invoice/send/fin/{id}', 'FinInvoiceController@invoice_send_fin');
Route::get('invoice/send/fin/', 'FinInvoiceController@list_invoice_send_fin');
Route::get('invoice/reject/fin/', 'FinInvoiceController@list_invoice_reject_fin');














































// master data

Route::get('user/create', 'HomeController@user_create');
Route::get('edit_password', 'HomeController@edit_password');
Route::post('save_edit_password', 'HomeController@save_edit_password');
Route::get('user/view', 'HomeController@user_view');
Route::post('user/save_create', 'HomeController@save_create');
Route::get('user/edit/{id}', 'HomeController@user_edit');
Route::get('user/delete/{id}', 'HomeController@user_delete');
Route::get('user/reset/{id}', 'HomeController@user_reset');
Route::post('user/save_edit', 'HomeController@save_edit');


Route::post('json/part_bank/{id}','HomeController@part_bank');
Route::post('json/part_bank_selected/{id}/{id2}','HomeController@part_bank_selected');
Route::post('json/account/{id}/{id2}','HomeController@account');

Route::get('data','HomeController@data');
Route::get('data_user','HomeController@data_user');
Route::post('import/vendor','HomeController@import_vendor');
Route::post('import/bank','HomeController@import_bank');
Route::post('import/vendor_bank','HomeController@vendor_bank');

// master vendor by Handika
Route::get('vendor/view_vendor','VendorController@index');
Route::post('vendor/save_create','VendorController@create');
Route::get('vendor/edit_vendor/{id}', 'VendorController@edit');
Route::get('vendor/delete/{id}', 'VendorController@destroy');
Route::post('vendor/save_edit', 'VendorController@save_edit');

//Bait
Route::get('payment', 'PaymentController@index');
Route::post('payment/save_payment','PaymentController@create');
Route::get('payment/edit_payment/{id} ', 'PaymentController@edit');
Route::post('payment/save_edit', 'PaymentController@save_edit');
Route::get('payment/delete/{id}', 'PaymentController@destroy');


// master bank by Fachrul
Route::get('bank/view_bank','bankController@index');
Route::post('bank/save_create','bankController@create');
Route::get('bank/edit_bank/{id}', 'bankController@edit');
Route::get('bank/delete/{id}', 'bankController@destroy');
Route::post('bank/save_edit', 'bankController@save_edit');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
