@extends('master.2columns-left')

@section('left')
@parent
@block('catalog/category-nav')
@stop


@section('content')

@block('catalog/product-block', array('paginate' => true))

@stop