<div class="col-md-12">
    <div class="radio">
        <label>
            <input type="radio" name="shipping_method" value="<?php echo \Goxob\Sale\Helper\Checkout::SHIPPING_METHOD_FREE?>" checked>
            {{trans('Free Shipping')}}
        </label>
    </div>
    <div class="radio">
        <label>
            <input type="radio" name="shipping_method" value="<?php echo \Goxob\Sale\Helper\Checkout::SHIPPING_METHOD_FLAT?>">
            {{trans('Flat Rate')}}
        </label>
    </div>
</div>
