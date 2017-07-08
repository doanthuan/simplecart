<div class="panel panel-default">
    <div class="panel-heading">
        <h4 class="panel-title">
            <a data-toggle="collapse" data-parent="#accordion" href="#review-panel">
                {{trans('6. Confirm Order')}}
            </a>
        </h4>
    </div>
    <div id="review-panel" class="panel-collapse collapse <?php echo Auth::check()?'in':''?>">
        <div class="panel-body">

            <?php echo Form::open(array('id' => 'review-form'))?>

                @block('sale/order-products', array('products' => $products, 'totalAmount' => $totalAmount))

                <div class="row">
                    <div class="col-md-12 text-right">
                        <button class="btn btn-sm btn-default" onclick="return cancelOrder()">{{trans('Cancel')}}</button>
                        <button class="btn btn-sm btn-success" id="btn-place-order" onclick="return placeOrder()">{{trans('Place Order')}}</button>
                    </div>
                </div>

            <?php echo Form::close()?>


        </div>
    </div>
</div>




<!--Popup Processing-->
<div class="modal fade bs-example-modal-lg" id="pleaseWaitDialog" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-vertical-centered">
        <div class="modal-content">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div style="padding: 10px;">
                        <h1>@lang('Processing')...</h1>
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
    function placeOrder()
    {
        $('#pleaseWaitDialog').modal();
        submitForm('#review-form', '{{url('checkout/place-order')}}');
        return false;
    }
    function cancelOrder()
    {
        if(confirm('{{trans('Do you want to cancel this order?')}}'))
        {
            submitForm('#review-form', '{{url('checkout/cancel-order')}}');
        }
        return false;
    }
</script>
