@extends('master.main')

@section('head')
@parent
<script src="{{url('media/bootstrap/js/bootstrap3-typeahead.min.js')}}"></script>
@stop



@section('content')
<?php echo Form::model($item, array('name' => 'adminForm', 'class' => 'form-horizontal', 'url' => 'admin/sale/order/store', 'autocomplete' => 'on'))?>

<ul class="nav nav-tabs" id="myTab">
    <li class="active"><a href="#product" data-toggle="tab">{{trans('Products')}}</a></li>
    <li><a href="#customer" data-toggle="tab">{{trans('Customer')}}</a></li>
    <li><a href="#billing" data-toggle="tab">{{trans('Billing Information')}}</a></li>
    <li><a href="#shipping" data-toggle="tab">{{trans('Shipping Information')}}</a></li>
    <li><a href="#shipping_method" data-toggle="tab">{{trans('Shipping Method')}}</a></li>
    <li><a href="#payment" data-toggle="tab">{{trans('Payment Information')}}</a></li>
</ul>
<div class="tab-content">
    <div class="tab-pane fade in active" id="product">
        @include('sale.order.edit.product')
    </div>
    <div class="tab-pane fade" id="customer">
        @include('sale.order.edit.customer')
    </div>
    <div class="tab-pane fade" id="billing">
        @include('sale.order.edit.billing')
    </div>

    <div class="tab-pane fade" id="shipping">
        @include('sale.order.edit.shipping')
    </div>

    <div class="tab-pane fade" id="shipping_method">
        @include('sale.order.edit.shipping_method')
    </div>

    <div class="tab-pane fade" id="payment">
        @include('sale.order.edit.payment')
    </div>

</div>

<?php echo Form::close();?>

@stop