@extends('master.2columns-right')

@section('right')
@parent
@block('catalog/product-block', array('title' => trans('Most View Products'), 'orderBy' => 'hits DESC', 'limit' => 5, 'cols' => 1))
@stop

@section('content')

@block('cms/content')

@stop