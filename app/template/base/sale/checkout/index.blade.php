@extends('master.1columns')

@section('head')
@parent
<script src="{{url('media/system/js/jquery.validate.min.js')}}"></script>
@stop

@section('content')
<div class="page-header">
    <h1>{{trans('Checkout')}}</h1>
</div>

<div class="panel-group" id="accordion">

    <?php if(!Auth::check()){?>
        @include('sale.checkout.index.account')
    <?php } ?>


    @include('sale.checkout.index.billing')

    <?php if(\Goxob::getSetting('shipping.enable') && \Goxob\Sale\Helper\Cart::hasShipping()){?>
    @include('sale.checkout.index.shipping')

    @include('sale.checkout.index.shipping_method')
    <?php } ?>

    @include('sale.checkout.index.payment')

    @include('sale.checkout.index.review')


</div>




<script>
    var step = 1;
    var enableShipping = {{(\Goxob::getSetting('shipping.enable') && \Goxob\Sale\Helper\Cart::hasShipping())?1:0}};

    $(document).ready(function(){

        $('#accordion').on('show.bs.collapse', function () {
            $('#accordion .in').collapse('hide');
        });

        $('#account-panel').on('show.bs.collapse', function () {
            step = 1;
        })

        $('#billing-panel').on('show.bs.collapse', function () {
            if(step < 2) return false;
            step = 2;
        })

        $('#shipping-panel').on('show.bs.collapse', function () {
            if(step < 3) return false;

            var shipFromBill = $('input[name="ship_from_bill"]:checked').val();
            if(shipFromBill == 1){
                return false;
            }
            step = 3;
        })

        $('#shipping-method-panel').on('show.bs.collapse', function () {
            if(step < 4) return false;
            step = 4;
        })

        $('#payment-panel').on('show.bs.collapse', function () {
            if(step < 5) return false;
            step = 5;
        })

        $('#review-panel').on('show.bs.collapse', function () {
            if(step < 6) return false;
            step = 6;
        })


        $('input[type=radio][name="account"]').change(function() {
            if (this.value == 'register') {
                //show password fields
                $('#password-row').show();
            }
            else if (this.value == 'guest') {
                //hide password fields
                $('#password-row').hide();
            }
        });


        $('input[type=radio][name="new_billing_address"]').change(function() {
            if (this.value == '1') {
                $('#new-billing-address').show();
                $('#exist-billing-address').hide();
            }
            else if (this.value == '0') {
                $('#new-billing-address').hide();
                $('#exist-billing-address').show();
            }
        });

        $('input[type=radio][name="new_shipping_address"]').change(function() {
            if (this.value == '1') {
                $('#new-shipping-address').show();
                $('#exist-shipping-address').hide();
            }
            else if (this.value == '0') {
                $('#new-shipping-address').hide();
                $('#exist-shipping-address').show();
            }
        });

    });

    function checkoutAccountNext()
    {
        step = 2;
        $('#billing-panel').collapse('show');
    }

    function checkoutBillingNext()
    {
        //validate billing information
        if(!$('#billing-form').valid()){
            return;
        }

        var postData = $('#billing-form').serializeArray();
        var formURL = $('#billing-form').attr("action");
        $.ajax(
            {
                url : formURL,
                type: "POST",
                data : postData,
                success:function(data, textStatus, jqXHR)
                {
                    if(enableShipping)
                    {
                        var shipFromBill = $('input[name="ship_from_bill"]:checked', '#billing-form').val();
                        if(shipFromBill == 1){
                            //skip shipping address step
                            step = 4;
                            $('#shipping-method-panel').collapse('show');
                        }
                        else{
                            //open shipping address panel
                            step = 3;
                            $('#shipping-panel').collapse('show');
                        }
                    }
                    else{
                        step = 5;
                        $('#payment-panel').collapse('show');
                    }
                },
                error: function(jqXHR, textStatus, errorThrown)
                {
                    //if fails
                    alert('Server has error. Please try again');
                }
            });

    }

    function checkoutShippingNext()
    {
        //validate shipping information
        if(!$('#shipping-form').valid())
        {
            return;
        }
        var postData = $('#shipping-form').serializeArray();
        var formURL = $('#shipping-form').attr("action");
        $.ajax(
            {
                url : formURL,
                type: "POST",
                data : postData,
                success:function(data, textStatus, jqXHR)
                {
                    step = 4;
                    $('#shipping-method-panel').collapse('show');

                },
                error: function(jqXHR, textStatus, errorThrown)
                {
                    //if fails
                    alert('Server has error. Please try again');
                }
            });
    }

    function checkoutShippingMethodNext()
    {
        //validate shipping method information
        if(!$('#shipping-method-form').valid())
        {
            return;
        }

        var postData = $('#shipping-method-form').serializeArray();
        var formURL = $('#shipping-method-form').attr("action");
        $.ajax(
            {
                url : formURL,
                type: "POST",
                data : postData,
                success:function(data, textStatus, jqXHR)
                {
                    step = 5;
                    $('#payment-panel').collapse('show');

                },
                error: function(jqXHR, textStatus, errorThrown)
                {
                    //if fails
                    alert('Server has error. Please try again');
                }
            });
    }

    function checkoutPaymentNext(){

        var postData = $('#payment-form').serializeArray();
        var formURL = $('#payment-form').attr("action");
        $.ajax(
            {
                url : formURL,
                type: "POST",
                data : postData,
                success:function(data, textStatus, jqXHR)
                {
                    step = 6;
                    $('#review-panel').collapse('show');

                },
                error: function(jqXHR, textStatus, errorThrown)
                {
                    //if fails
                    alert('Server has error. Please try again');
                }
            });
    }

</script>
@stop