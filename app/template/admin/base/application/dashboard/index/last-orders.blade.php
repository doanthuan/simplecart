<div>
    <table class="table table-bordered table-hover table-striped tablesorter">
        <thead>
        <tr>
            <th>{{trans('Order ID')}}</th>
            <th>{{trans('Customer')}}</th>
            <th>{{trans('Status')}}</th>
            <th>{{trans('Amount')}} (USD)</th>
            <th>{{trans('Order Time')}}</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($lastOrders as $order){ ?>
            <tr>
                <td><?php echo $order->getOrderId();?></td>
                <td><?php echo $order->customer_email?></td>
                <td><?php echo $order->getStatus()?></td>
                <td><?php echo $order->amount?></td>
                <td><?php echo $order->created_at?></td>
            </tr>
        <?php }
        ?>
        </tbody>
    </table>
</div>
<div class="text-right">
    <a href="{{url('admin/sale/order')}}">{{trans('View All Orders')}} <i class="fa fa-arrow-circle-right"></i></a>
</div>