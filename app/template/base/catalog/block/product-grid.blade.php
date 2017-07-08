<div class="row product-grid">
    <?php if(count($products) > 0){
        foreach ($products as $product) {?>
            <div class="col-sm-<?php echo $cssColumns;?>">
                @include('catalog.block.product-grid-item')
            </div>
        <?php } ?>
    <?php } ?>
</div>
