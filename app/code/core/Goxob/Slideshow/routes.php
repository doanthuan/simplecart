<?php
//admin
Route::get('admin/slideshow', '\Goxob\Slideshow\Admin\ItemController@index');
\Goxob::routeAdminController('slideshow','item');
\Goxob::routeAdminController('slideshow','group');