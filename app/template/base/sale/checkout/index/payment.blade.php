<div class="panel panel-default">
    <div class="panel-heading">
        <h4 class="panel-title">
            <a data-toggle="collapse" data-parent="#accordion" href="#payment-panel">
                {{trans('5. Payment Method')}}
            </a>
        </h4>
    </div>
    <div id="payment-panel" class="panel-collapse collapse">
        <div class="panel-body">

            <?php echo Form::open(array('url' => 'checkout/save-payment', 'id' => 'payment-form'))?>
            <div class="radio">
                <label>
                    <input type="radio" name="payment_method" value="<?php echo \Goxob\Sale\Helper\Checkout::PAY_METHOD_CASH?>" checked>
                    {{trans('Cash On Delivery')}}
                </label>
            </div>

            <div class="radio">
                <label>
                    <input type="radio" name="payment_method" value="<?php echo \Goxob\Sale\Helper\Checkout::PAY_METHOD_PAYPAL?>">
                    {{trans('Paypal')}}
                </label>
            </div>


            <div class="row">
                <div class="col-md-12 text-right">
                    <button type="button" class="btn btn-sm btn-primary" onclick="checkoutPaymentNext()">{{trans('Continue')}}</button>
                </div>
            </div>
            <?php echo Form::close()?>

        </div>
    </div>
</div>