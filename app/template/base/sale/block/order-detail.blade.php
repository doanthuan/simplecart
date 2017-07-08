<div class="row">
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">{{trans('Order Information')}}</div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-6">{{trans('Order Date')}}:</div>
                    <div class="col-md-6"><strong>{{$order->created_at}}</strong></div>
                </div>
                <div class="row">
                    <div class="col-md-6">{{trans('Order Status')}}:</div>
                    <div class="col-md-6"><strong><?php echo \Goxob\Sale\Helper\Order::getStatusString($order->status); ?></strong></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">{{trans('Customer Information')}}</div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-6">{{trans('Customer Email')}}:</div>
                    <div class="col-md-6"><strong>{{$order->customer_email}}</strong></div>
                </div>
                <div class="row">
                    <div class="col-md-6">{{trans('Customer Phone')}}:</div>
                    <div class="col-md-6"><strong>{{$order->customer_phone}}</strong></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <?php if(isset($billingAddress) && !empty($billingAddress)){?>
        <div class="panel panel-default">
            <div class="panel-heading">{{trans('Billing Address')}}</div>
            <div class="panel-body">
                @block('customer/address-info', array('address' => $billingAddress))
            </div>
        </div>
        <?php }?>
    </div>
    <div class="col-md-6">
        <?php if(isset($shippingAddress) && !empty($shippingAddress)){?>
        <div class="panel panel-default">
            <div class="panel-heading">{{trans('Shipping Address')}}</div>
            <div class="panel-body">
                @block('customer/address-info', array('address' => $shippingAddress))
            </div>
        </div>
        <?php }?>
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-heading">{{trans('Items Ordered')}}</div>
    <div class="panel-body">
        @block('sale/order-products', array('products' => $products, 'totalAmount' => $order->amount))
    </div>
</div>
