<?php

//application
//default homepage route
Route::get( 'products/{cid?}', '\Goxob\Catalog\ProductController@index');

Route::post('products/post-search',             '\Goxob\Catalog\ProductController@postSearch');
Route::get( 'products/search/{search}',         '\Goxob\Catalog\ProductController@search');
Route::get( 'products/ajax-search/{search}',    '\Goxob\Catalog\ProductController@ajaxSearch');
Route::get( 'categories/ajax-search/{search}',    '\Goxob\Catalog\CategoryController@ajaxSearch');

Route::get( 'product/{pid?}',       '\Goxob\Catalog\ProductController@info');
Route::post('product/post-review',  '\Goxob\Catalog\ProductController@postReview');

//backend
//default admin catalog route
Route::get('admin/catalog', '\Goxob\Catalog\Admin\ProductController@index');

//routes for product backend
\Goxob::routeAdminController('catalog','product');
Route::group(array('prefix' => 'admin/catalog/product'), function()
{
    Route::get('get-attributes', '\Goxob\Catalog\Admin\ProductController@getAttributes');

    Route::get('get-import', '\Goxob\Catalog\Admin\ProductController@getImport');

    Route::post('post-import', '\Goxob\Catalog\Admin\ProductController@postImport');

    Route::match(array('GET', 'POST'), 'export', '\Goxob\Catalog\Admin\ProductController@export');
});

//routes for category
\Goxob::routeAdminController('catalog','category');

//routes for attributes
\Goxob::routeAdminController('catalog','attribute');

//routes for attribute-sets
\Goxob::routeAdminController('catalog','attribute-set');

//routes for reviews
\Goxob::routeAdminController('catalog','review');

//routes for vendor
\Goxob::routeAdminController('catalog','vendor');
