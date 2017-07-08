<?php

Route::get( 'pages/{alias}',    '\Goxob\Cms\ContentController@category');
Route::get( 'page/{alias}',    '\Goxob\Cms\ContentController@page');

//admin
Route::get('admin/cms', '\Goxob\Cms\Admin\ContentController@index');
\Goxob::routeAdminController('cms','content');
\Goxob::routeAdminController('cms','category');

