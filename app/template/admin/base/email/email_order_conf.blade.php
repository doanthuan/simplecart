<p>{{trans('Hello')}} {{$username}}!</p>
<p>{{trans('Thank you for your order at')}} {{$siteName}}. {{trans('Your order is waiting for processing')}}.</p>

@block('sale/order-detail', array('order_id' => $orderId, 'template' => 'sale.block.order-detail-email', 'frontend' => true))

<br><br>
<p><span style="line-height: 1.3em;">{{trans('Sincerely')}},</span></p>
<p>{{$siteName}}<br /><a href="{{$siteUrl}}">{{$siteUrl}}</a></p>