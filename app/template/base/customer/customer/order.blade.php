@extends('master.customer')

@section('content')

    <h2>{{trans('Order History')}}</h2>

    <table class="table table-bordered table-hover table-striped tablesorter">
        <thead>
        <tr>
            <th>{{trans('Order ID')}}</th>
            <th>{{trans('Status')}}</th>
            <th>{{trans('Amount')}} (USD)</th>
            <th>{{trans('Order Time')}}</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($orders as $order){?>
            <tr>
                <td><?php echo $order->getOrderId();?></td>
                <td><?php echo $order->getStatus()?></td>
                <td><?php echo $order->amount?></td>
                <td><?php echo $order->created_at?></td>
                <td><a href="{{url('customer/order-detail/'.$order->order_id)}}">{{trans('Detail')}}</a></td>
            </tr>
        <?php }
        ?>
        </tbody>
    </table>

@stop