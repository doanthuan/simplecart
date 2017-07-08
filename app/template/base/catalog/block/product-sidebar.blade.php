<div class="panel panel-default">
    <div class="panel-heading">
        <?php echo $title;?>
    </div>
    <div class="panel-body">
        <div class="row product-sidebar">
            <?php if(count($products) > 0){
                foreach ($products as $product) {?>
                    <div class="col-xs-12">
                        @include('catalog.block.product-grid-item')
                    </div>
                <?php } ?>
            <?php } ?>
        </div>
    </div>
</div>

