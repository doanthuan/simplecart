@extends('master.1columns')

@section('head')
@parent
<script src="{{url('media/system/js/jquery.validate.min.js')}}"></script>
@stop

@section('content')
<?php echo Form::open(array('id' => 'cart-form'))?>

    <input type="hidden" name="product_id" id="product_id">

    <div class="page-header">
        <h1>{{trans('Shopping Cart')}}</h1>
    </div>

    <?php if(empty($products)){ ?>
        <div class="content">Your shopping cart is empty!</div>
        <div class="row">
            <div class="col-md-12 text-right">
                <button type="button" class="btn btn-sm btn-primary" onclick="setLocation('{{url('products')}}')">{{trans('Continue Shopping')}}</button>
            </div>
        </div>
    <?php }else{ ?>

    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th class="col-md-1">{{trans('Image')}}</th>
                    <th class="col-md-5">{{trans('Product Name')}}</th>
                    <th class="col-md-1">{{trans('Quantity')}}</th>
                    <th class="col-md-2">{{trans('Unit Price')}}</th>
                    <th class="col-md-2">{{trans('Total')}}</th>
                    <th class="col-md-1"></th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach($products as $product){?>
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
                        <input type="text" name="cart_qty[]" value="{{$product->getCartQty()}}" size="1">
                    </td>
                    <td class="price"><?php echo \Goxob\Core\Helper\Data::formatPrice($product->price);?></td>
                    <td class="total"><?php echo \Goxob\Core\Helper\Data::formatPrice($product->getTotal())?></td>
                    <td>
                        <button type="button" class="btn btn-sm btn-danger" onclick="removeCartItem('{{$product->product_id}}','{{url('cart/remove')}}' )">{{trans('Remove')}}</button>
                    </td>

                </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-3">
            <button type="button" class="btn btn-sm btn-primary" onclick="setLocation('{{url('products')}}')">{{trans('Continue Shopping')}}</button>
        </div>
        <div class="col-sm-3 col-sm-offset-6 text-right">
            <button type="button" class="btn btn-sm btn-danger" onclick="submitForm('#cart-form', '{{url('cart/remove-all')}}')">{{trans('Clear Cart')}}</button>
            <button type="button" class="btn btn-sm btn-primary" onclick="submitForm('#cart-form', '{{url('cart/update')}}')">{{trans('Update Cart')}}</button>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="cart-total text-right">
                <strong>{{trans('Total')}}:</strong> <?php echo \Goxob\Core\Helper\Data::formatPrice($totalAmount);?>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-12 text-right">
            <button type="button" class="btn btn-success" onclick="setLocation('{{url('checkout')}}')">{{trans('Checkout')}}</button>
        </div>
    </div>

    <?php }?>

<?php echo Form::close()?>

<script>
    function removeCartItem(productId, url){
        $('#product_id').val(productId);
        submitForm('#cart-form', url);
    }
</script>

@stop