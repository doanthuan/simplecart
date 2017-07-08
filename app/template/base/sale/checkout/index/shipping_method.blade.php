<div class="panel panel-default">
    <div class="panel-heading">
        <h4 class="panel-title">
            <a data-toggle="collapse" data-parent="#accordion" href="#shipping-method-panel">
                {{trans('4. Shipping Method')}}
            </a>
        </h4>
    </div>
    <div id="shipping-method-panel" class="panel-collapse collapse">
        <div class="panel-body">

            <?php echo Form::open(array('url' => 'checkout/save-shipping-method', 'id' => 'shipping-method-form'))?>
            <div class="radio">
                <label>
                    <input type="radio" name="shipping_method" value="<?php echo \Goxob\Sale\Helper\Checkout::SHIPPING_METHOD_FLAT?>" checked>
                    {{trans('Flat Rate')}}
                </label>
            </div>

            <div class="row">
                <div class="col-md-12 text-right">
                    <button type="button" class="btn btn-sm btn-primary" onclick="checkoutShippingMethodNext()">{{trans('Continue')}}</button>
                </div>
            </div>
            <?php echo Form::close()?>

        </div>
    </div>
</div>