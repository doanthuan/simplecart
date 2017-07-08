<div class="panel panel-default">
    <div class="panel-heading">
        <h4 class="panel-title">
            <a data-toggle="collapse" data-parent="#accordion" href="#account-panel">
                {{trans('1. Checkout Options')}}
            </a>
        </h4>
    </div>
    <div id="account-panel" class="panel-collapse collapse in">
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-6">
                    <h4>{{trans('New Customer')}}</h4>
                    <p class="help-block">{{trans('Checkout Options')}}:</p>
                    <div class="radio">
                        <label>
                            <input type="radio" name="account" value="register" checked>
                            {{trans('Register Account')}}
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="account" value="guest">
                            {{trans('Guest Checkout')}}
                        </label>
                    </div>
                    <p class="help-block">{{trans('By creating an account you will be able to shop faster, be up to date
                        on an order\'s status, and keep track of the orders you have previously made')}}</p>
                    <div class="row" style="margin-top:60px;">
                        <div class="col-md-12">
                            <button type="button" class="btn btn-sm btn-primary" onclick="checkoutAccountNext()">{{trans('Continue')}}</button>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <h4>@lang('Returning Customer')</h4>
                    @block('customer/login-form', array('back-url' => url('checkout')))
                </div>
            </div>

        </div>
    </div>
</div>