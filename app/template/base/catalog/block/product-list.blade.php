<div class="row product-list">
    <?php if(count($products) > 0){
        foreach ($products as $product) {?>
            <div class="row">
                <div class="col-xs-4 col-sm-2 col-md-2 center_text">
                    <div class="thumbnail">
                        <a href="<?php echo \Goxob\Catalog\Helper\Product::getLink($product);?>" >
                            <img src="<?php echo \Goxob\Catalog\Helper\Product::getDefaultImage($product);?>">
                        </a>
                    </div>
                </div>
                <div class="col-xs-8 col-sm-8 col-md-7">
                    <div class="product-name">
                        <a href="<?php echo \Goxob\Catalog\Helper\Product::getLink($product);?>" title="">
                            <?php echo \Goxob\Catalog\Helper\Product::getName($product);?>
                        </a>
                    </div>
                    <div class="description">
                        {{$product->short_description}}
                    </div>
                </div>
                <div class="col-xs-6 col-sm-2 col-md-3 pull-right center_text">
                    <div class="price-box">
                        <span class="price"><?php echo \Goxob\Core\Helper\Data::formatPrice($product->price);?></span>
                    </div>
                </div>
            </div>
        <?php } ?>
    <?php } ?>
</div>
