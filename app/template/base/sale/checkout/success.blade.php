@extends('master.1columns')

@section('content')

<div class="page-header">
    <h1>{{trans('Your order has been received')}}</h1>
</div>

<p>{{trans('Thank you for your purchase')}}</p>
<p>{{trans('Your order # is')}}: <?php echo \Goxob\Sale\Helper\Order::formatOrderId($orderId)?></p>
<p>{{trans('You will receive an order confirmation email with details of your order')}}</p>
<div class="row">
    <div class="col-md-12 text-right">
        <button type="button" class="btn btn-sm btn-primary" onclick="setLocation('{{url('/')}}')">{{trans('Continue')}}</button>
    </div>
</div>

@stop