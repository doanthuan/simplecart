<div>
    <table class="table table-bordered table-hover table-striped tablesorter">
        <thead>
        <tr>
            <th>{{trans('Product Name')}}</th>
            <th>{{trans('Price')}}</th>
            <th>{{trans('Viewed')}}</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($mostViewProducts as $product){ ?>
            <tr>
                <td><?php echo $product->name;?></td>
                <td><?php echo number_format($product->price, 2)?></td>
                <td><?php echo $product->hits?></td>
            </tr>
        <?php }
        ?>
        </tbody>
    </table>
</div>