<table width="100%">
    <tr>
        <td>
            <table width="100%" border="1" cellspacing="0" cellpadding="10" style="border-collapse: collapse">
                <tr>
                    <td colspan="2" style="background: #DCEFF5;"><strong>{{trans('Order Information')}}</strong></td>
                </tr>
                <tr>
                    <td>{{trans('Order Number')}}</td>
                    <td><strong>{{\Goxob\Sale\Helper\Order::formatOrderId($order->order_id)}}</strong></td>
                </tr>
                <tr>
                    <td>{{trans('Order Date')}}</td>
                    <td><strong>{{\Goxob\Core\Helper\Data::formatDateTime($order->created_at)}}</strong></td>
                </tr>
                <tr>
                    <td>{{trans('Order Status')}}:</td>
                    <td><strong>{{\Goxob\Sale\Helper\Order::getStatusString($order->status)}}</strong></td>
                </tr>
            </table>
        </td>
        <td>
            <table width="100%" border="1" cellspacing="0" cellpadding="10" style="border-collapse: collapse">
                <tr>
                    <td colspan="2" style="background: #DCEFF5;"><strong>{{trans('Customer Information')}}</strong></td>
                </tr>
                <tr>
                    <td>{{trans('Customer Email')}}</td>
                    <td><strong>{{$order->customer_email}}</strong></td>
                </tr>
                <tr>
                    <td>{{trans('Order Status')}}:</td>
                    <td><strong>{{$order->customer_phone}}</strong></td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td>
            <?php if(isset($billingAddress) && !empty($billingAddress)){?>
            <table width="100%" border="1" cellspacing="0" cellpadding="10" style="border-collapse: collapse">
                <tr>
                    <td style="background: #DCEFF5;"><strong>{{trans('Billing Address')}}</strong></td>
                </tr>
                <tr>
                    <td>@block('customer/address-info', array('address' => $billingAddress))</td>
                </tr>
            </table>
            <?php } ?>
        </td>
        <td>
            <?php if(isset($shippingAddress) && !empty($shippingAddress)){?>
                <table width="100%" border="1" cellspacing="0" cellpadding="10" style="border-collapse: collapse">
                    <tr>
                        <td style="background: #DCEFF5;"><strong>{{trans('Shipping Address')}}</strong></td>
                    </tr>
                    <tr>
                        <td>@block('customer/address-info', array('address' => $shippingAddress))</td>
                    </tr>
                </table>
            <?php } ?>
        </td>
    </tr>
</table>

<br>
<p><strong>{{trans('Items Ordered')}}:</strong></p>
<br>

<table width="100%" border="1" cellspacing="0" cellpadding="10" style="border-collapse: collapse">
    <thead>
    <tr style="background: #DCEFF5;">
        <th class="col-md-1">{{trans('Image')}}</th>
        <th class="col-md-5">{{trans('Product Name')}}</th>
        <th class="col-md-1">{{trans('Quantity')}}</th>
        <th class="col-md-2">{{trans('Unit Price')}}</th>
        <th class="col-md-2">{{trans('Total')}}</th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach($products as $product){
        ?>
        <tr>
            <td class="image muted center_text">
                <a href="<?php echo \Goxob\Catalog\Helper\Product::getLink($product);?>">
                    <img src="<?php echo \Goxob\Catalog\Helper\Product::getDefaultImage($product);?>" height="75">
                </a>
            </td>
            <td class="name">
                <a href="<?php echo \Goxob\Catalog\Helper\Product::getLink($product);?>">
                    <?php echo \Goxob\Catalog\Helper\Product::getName($product);?>
                </a>
            </td>
            <td class="quantity">
                {{$product->getCartQty()}}
            </td>
            <td class="price"><?php echo \Goxob\Core\Helper\Data::formatPrice($product->price);?></td>
            <td class="total"><?php echo \Goxob\Core\Helper\Data::formatPrice($product->getTotal())?></td>
        </tr>
    <?php } ?>
    </tbody>
</table>

<p style="float: right">
            <strong>{{trans('Total')}}:</strong> <?php echo \Goxob\Core\Helper\Data::formatPrice($order->amount);?>
</p>