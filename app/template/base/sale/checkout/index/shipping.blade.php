<div class="panel panel-default">
    <div class="panel-heading">
        <h4 class="panel-title">
            <a data-toggle="collapse" data-parent="#accordion" href="#shipping-panel"">
            {{trans('3. Shipping Information')}}
            </a>
        </h4>
    </div>
    <div id="shipping-panel" class="panel-collapse collapse">
        <div class="panel-body">

            <?php echo Form::open(array('url' => 'checkout/save-shipping', 'id' => 'shipping-form'))?>
            @if (isset($shippingAddresses))
            <div class="radio">
                <label>
                    <input type="radio" name="new_shipping_address" value="0" checked>
                    {{trans('I want to use an existing address')}}
                </label>
            </div>
            <div id="exist-shipping-address">
                <select name="shipping_address_id" class="form-control">
                    @foreach ($shippingAddresses as $address)
                    <option value="{{$address->address_id}}">{{$address->first_name}} {{$address->first_name}}, {{$address->address}}, {{$address->city}}</option>
                    @endforeach
                </select>
            </div>

            <div class="radio">
                <label>
                    <input type="radio" name="new_shipping_address" value="1">
                    {{trans('I want to use new address')}}
                </label>
            </div>
            @endif

            <div id="new-shipping-address" {{ isset($shippingAddresses) ? 'style="display:none"' : '' }}>
                @block('customer/address-edit', array('type' => 'shipping'))
            </div>

            <div class="row">
                <div class="col-md-12 text-right">
                    <button type="button" class="btn btn-sm btn-primary" onclick="checkoutShippingNext()">{{trans('Continue')}}</button>
                </div>
            </div>

            <?php echo Form::close()?>

        </div>
    </div>
</div>