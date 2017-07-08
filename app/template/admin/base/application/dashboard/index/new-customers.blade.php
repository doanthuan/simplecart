<div>
    <table class="table table-bordered table-hover table-striped tablesorter">
        <thead>
        <tr>
            <th>{{trans('Customer Name')}}</th>
            <th>{{trans('Number of Orders')}}</th>
            <th>{{trans('Average Order Amount')}}</th>
            <th>{{trans('Total Order Amount')}}</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($newCustomers as $customer){ ?>
            <tr>
                <td><?php echo $customer->getFullName();?></td>
                <td><?php echo $customer->num_order?></td>
                <td><?php echo number_format($customer->avg_amount, 2)?></td>
                <td><?php echo number_format($customer->total_amount, 2)?></td>
            </tr>
        <?php }
        ?>
        </tbody>
    </table>
</div>