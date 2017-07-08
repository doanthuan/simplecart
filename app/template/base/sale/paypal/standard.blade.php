@extends('master.1columns')

@section('content')

<form name="_cart" action="https://www.sandbox.paypal.com/us/cgi-bin/webscr" method="post" id="paypal-form">
    <input type="hidden" name="cmd" value="_cart">
    <input type="hidden" name="business" value="doanvuthuan-facilitator@gmail.com">
    <input type="hidden" name="currency_code" value="USD">
    <input type="hidden" name="upload" value="1">
    <?php foreach($products as $i => $product){?>
        <input type="hidden" name="item_name_<?php echo $i+1?>" value="<?php echo $product->name?>">
        <input type="hidden" name="item_number_<?php echo $i+1?>" value="<?php echo $product->product_id?>">
        <input type="hidden" name="amount_<?php echo $i+1?>" value="<?php echo $product->getTotal()?>">
    <?php } ?>
    <input type="hidden" name="notify_url" value="<?php echo url('paypal/paypal-notify')?>">
    <input type="hidden" name="return" value="<?php echo url('paypal/paypal-return')?>">

    <input type="hidden" name="first_name" value="{{$billing->first_name}}">
    <input type="hidden" name="last_name" value="{{$billing->last_name}}">
    <input type="hidden" name="address1" value="{{$billing->address}}">
    <input type="hidden" name="address2" value="" >
    <input type="hidden" name="city" value="{{$billing->city}}">
    <input type="hidden" name="state" value="{{$billing->state}}">
    <input type="hidden" name="zip" value="{{$billing->zipcode}}">
    <input type="hidden" name="night_phone_a" value="{{substr($customer->phone,0, 3)}}">
    <input type="hidden" name="night_phone_b" value="{{substr($customer->phone,3, 3)}}">
    <input type="hidden" name="night_phone_c" value="{{substr($customer->phone,6, 4)}}">
    <input type="hidden" name="email" value="{{$customer->email}}">

</form>


<!--Popup Processing-->
<div class="modal fade " id="pleaseWaitDialog" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-vertical-centered">
        <div class="modal-content">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div style="padding: 10px;">
                        <h1>{{trans('Redirecting To Paypal')}}...</h1>
                        <div class="progress progress-striped active">
                            <div class="progress-bar"  role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function(){
        $('#pleaseWaitDialog').modal();
        $('#paypal-form').submit();
    });

</script>


@stop