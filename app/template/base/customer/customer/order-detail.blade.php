@extends('master.customer')

@section('content')
<h2>{{trans('Order Detail')}}</h2>

@block('sale/order-detail', array('order_id' => $orderId))

@stop