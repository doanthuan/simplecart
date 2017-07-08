<div class="row">
    <div class="col-sm-12">
        <table class="table table-bordered table-striped">
            <thead>
            <tr>
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
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="cart-total text-right">
            <strong>{{trans('Total')}}:</strong> <?php echo \Goxob\Core\Helper\Data::formatPrice($totalAmount);?>
        </div>
    </div>
</div>