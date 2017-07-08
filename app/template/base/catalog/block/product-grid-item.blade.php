<div class="product-item">
    <div class="thumbnail">
        <a href="<?php echo \Goxob\Catalog\Helper\Product::getLink($product);?>" >
            <img src="<?php echo \Goxob\Catalog\Helper\Product::getDefaultImage($product);?>">
        </a>
        <div class="product-name">
            <a href="<?php echo \Goxob\Catalog\Helper\Product::getLink($product);?>" title="">
                <?php echo \Goxob\Catalog\Helper\Product::getName($product);?>
            </a>
        </div>
        <div class="price-box">
            <span class="price"><?php echo \Goxob\Core\Helper\Data::formatPrice($product->price);?></span>
        </div>
    </div>
</div>