<?php

//default user route
Route::get('admin/user', '\Goxob\User\Admin\UserController@index');

//routes for user
\Goxob::routeAdminController('user','user');

//routes for authentication
Route::get('admin/login', '\Goxob\User\Admin\AuthenController@login');
Route::post('admin/login', '\Goxob\User\Admin\AuthenController@postLogin');

Route::get('admin/logout', '\Goxob\User\Admin\AuthenController@logout');

//routes for role
\Goxob::routeAdminController('user','role');


