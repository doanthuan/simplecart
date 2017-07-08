@extends('master.main')

@section('content')

@block('sale/order-detail', array('order_id' => $orderId, 'frontend' => true))

@stop