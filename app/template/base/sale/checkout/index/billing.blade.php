<div class="panel panel-default">
    <div class="panel-heading">
        <h4 class="panel-title">
            <a data-toggle="collapse" data-parent="#accordion" href="#billing-panel">
                {{trans('2. Account & Billing Information')}}
            </a>
        </h4>
    </div>
    <div id="billing-panel" class="panel-collapse collapse <?php echo Auth::check()?'in':''?>">
        <div class="panel-body">

            <?php echo Form::open(array('url' => 'checkout/save-account-billing', 'id' => 'billing-form'))?>
            @if (isset($billingAddresses))
            <div class="radio">
                <label>
                    <input type="radio" name="new_billing_address" value="0" checked>
                    <?php echo Form::radio('new_billing_address', "0", true);?>
                    {{trans('I want to use an existing address')}}
                </label>
            </div>

            <select name="billing_address_id" class="form-control" id="exist-billing-address">
                @foreach ($billingAddresses as $address)
                    <option value="{{$address->address_id}}">{{$address->first_name}} {{$address->first_name}}, {{$address->address}}, {{$address->city}}</option>
                @endforeach
            </select>

            <div class="radio">
                <label>
                    <?php echo Form::radio('new_billing_address', "1");?>
                    {{trans('I want to use new address')}}
                </label>
            </div>
            @endif

            <div id="new-billing-address" {{ isset($billingAddresses) ? 'style="display:none"' : '' }}>

                @unless (Auth::check())
                <div class="form-group">
                    <label for="city">{{trans('Email address')}}</label>
                    <div class="row">
                        <div class="col-sm-4">
                            <?php echo Form::email('customer_email', null, array('class' => 'form-control required email', 'placeholder' => 'Enter email'))?>
                        </div>
                    </div>
                </div>

                <div class="form-group" id="password-row">
                    <div class="row">
                        <label class="col-sm-4 " for="password">{{trans('Password')}}</label>
                        <label class="col-sm-4 " for="password_confirm">{{trans('Password Confirm')}}</label>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <?php echo Form::password('password', array('class' => 'form-control required', 'placeholder' => 'Password'))?>
                        </div>
                        <div class="col-sm-4">
                            <?php echo Form::password('password_confirm', array('class' => 'form-control required', 'placeholder' => 'Password Confirm'))?>
                        </div>
                    </div>
                </div>
                @endunless

                @block('customer/address-edit', array('type' => 'billing'))


            </div>

            <br>
            <br>
            <?php if(\Goxob::getSetting('shipping.enable') && \Goxob\Sale\Helper\Cart::hasShipping()){?>
            <div class="radio">
                <label>
                    <input type="radio" name="ship_from_bill" value="1" checked>
                    {{trans('Ship to this address')}}
                </label>
            </div>
            <div class="radio">
                <label>
                    <input type="radio" name="ship_from_bill" value="0">
                    {{trans('Ship to difference address')}}
                </label>
            </div>
        <?php }?>
            <div class="row">
                <div class="col-md-12 text-right">
                    <button type="button" class="btn btn-sm btn-primary" onclick="checkoutBillingNext()">{{trans('Continue')}}</button>
                </div>
            </div>

            <?php echo Form::close()?>

        </div>
    </div>
</div>