@extends('master.3columns')

@section('top-content')
@parent
@block('slideshow/slideshow', array('alias' => 'group-1'))
@stop

@section('left')
@parent
@block('catalog/category-nav')
@stop

@section('right')
@parent
@block('catalog/product-block', array('title' => trans('Most View Products'), 'orderBy' => 'hits DESC', 'limit' => 5, 'cols' => 1))
@stop

@section('content')

@block('catalog/product-block', array('title' => trans('Phone'), 'category' => 9, 'orderBy' => 'created_at DESC', 'limit' => 8, 'cols' => 4))

@block('catalog/product-block', array('title' => trans('Laptop'), 'category' => 10, 'orderBy' => 'created_at DESC', 'limit' => 8, 'cols' => 4))

@block('catalog/product-block', array('title' => trans('Tablet'), 'category' => 29, 'orderBy' => 'created_at DESC', 'limit' => 8, 'cols' => 4))

@stop