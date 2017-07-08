<?php

Route::get( 'login',    '\Goxob\Customer\AuthController@login');
Route::post('login',    '\Goxob\Customer\AuthController@postLogin');
Route::get( 'logout',   '\Goxob\Customer\AuthController@logout');

Route::get( 'register', '\Goxob\Customer\AuthController@register');
Route::post('register', '\Goxob\Customer\AuthController@postRegister');

Route::get( 'remind',   '\Goxob\Customer\RemindersController@getRemind');
Route::post('remind',   '\Goxob\Customer\RemindersController@postRemind');

Route::get( 'reset/{token}',    '\Goxob\Customer\RemindersController@getReset');
Route::post('reset',            '\Goxob\Customer\RemindersController@postReset');

Route::get( 'customer',                     '\Goxob\Customer\CustomerController@index');
Route::post('customer/save-account',        '\Goxob\Customer\CustomerController@saveAccount');
Route::get( 'customer/order-history',       '\Goxob\Customer\CustomerController@orderHistory');
Route::get( 'customer/order-detail/{id}',   '\Goxob\Customer\CustomerController@orderDetail');

Route::get( 'customer/address',             '\Goxob\Customer\AddressController@index');
Route::post('customer/address/delete',      '\Goxob\Customer\AddressController@delete');
Route::get( 'customer/address/edit/{id}',   '\Goxob\Customer\AddressController@edit');
Route::post('customer/address/store',       '\Goxob\Customer\AddressController@store');


//admin customer route
Route::get('admin/customer', '\Goxob\Customer\Admin\CustomerController@index');

//routes for customer
\Goxob::routeAdminController('customer','customer');
Route::get('admin/customer/customer/ajax-search', '\Goxob\Customer\Admin\CustomerController@ajaxSearch');

//routes for address
\Goxob::routeAdminController('customer','address');


