<?php


//default homepage route
Route::get('/', '\Goxob\Application\HomeController@index');
Route::get('/error', array('as' => 'error', 'uses' => '\Goxob\Application\ErrorController@index'));

Route::get('contact', '\Goxob\Application\ContactController@index');
Route::post('contact/post-contact', '\Goxob\Application\ContactController@postContact');

//default admin route
Route::get('admin', '\Goxob\Application\Admin\DashboardController@index');

//dashboard route
Route::get('admin/dashboard', '\Goxob\Application\Admin\DashboardController@index');
Route::get('admin/dashboard/load-chart-data/{range}', '\Goxob\Application\Admin\DashboardController@loadChartData');

//setting route
Route::get('admin/setting', '\Goxob\Application\Admin\SettingController@index');
Route::post('admin/setting/store', '\Goxob\Application\Admin\SettingController@store');

