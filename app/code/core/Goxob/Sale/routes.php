<?php

/* FRONTEND */
//routes for cart
Route::get ('cart',             '\Goxob\Sale\CartController@index');
Route::post('cart/add',         '\Goxob\Sale\CartController@add');
Route::post('cart/update',      '\Goxob\Sale\CartController@update');
Route::post('cart/remove',      '\Goxob\Sale\CartController@remove');
Route::post('cart/remove-all',  '\Goxob\Sale\CartController@removeAll');

//routes for checkout
Route::get ('checkout',                 '\Goxob\Sale\CheckoutController@index');
Route::post('checkout/save-account-billing',   '\Goxob\Sale\CheckoutController@saveAccountBilling');
Route::post('checkout/save-shipping',   '\Goxob\Sale\CheckoutController@saveShipping');
Route::post('checkout/save-shipping-method',   '\Goxob\Sale\CheckoutController@saveShippingMethod');
Route::post('checkout/save-payment',   '\Goxob\Sale\CheckoutController@savePayment');
Route::get ('checkout/review',          '\Goxob\Sale\CheckoutController@review');
Route::post('checkout/place-order',     '\Goxob\Sale\CheckoutController@placeOrder');
Route::post('checkout/cancel-order',    '\Goxob\Sale\CheckoutController@cancelOrder');
Route::get ('checkout/success',         '\Goxob\Sale\CheckoutController@success');

Route::get( 'paypal/',          '\Goxob\Sale\PaypalController@index');
Route::any( 'paypal/paypal-return',   '\Goxob\Sale\PaypalController@paypalReturn');
Route::any( 'paypal/paypal-notify',   '\Goxob\Sale\PaypalController@paypalNotify');
Route::get( 'paypal/test-log',          '\Goxob\Sale\PaypalController@testLog');
Route::get( 'paypal/test-ipn',          '\Goxob\Sale\PaypalController@testVerifyIPN');


/* BACKEND */
//default admin sale route
Route::get('/admin/sale', '\Goxob\Sale\Admin\OrderController@index');

//routes for admin order controller
\Goxob::routeAdminController('sale','order');
Route::get ('/admin/sale/order/detail/{id}', '\Goxob\Sale\Admin\OrderController@detail');
Route::post('/admin/sale/order/update-status', '\Goxob\Sale\Admin\OrderController@updateStatus');