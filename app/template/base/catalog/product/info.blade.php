@extends('master.2columns-right')

@section('head')
@parent
<script src="{{url('media/system/js/jquery.validate.min.js')}}"></script>
<link rel="stylesheet" href="{{url('media/system/css/imgzoom.css')}}" type="text/css" media="all" />
<script src="{{url('media/system/js/featuredimagezoomer.js')}}"></script>
@stop


@section('right')
@parent
@block('catalog/product-block', array('title' => trans('Most View Products'), 'orderBy' => 'hits DESC', 'limit' => 5 , 'cols' => 1))
@stop


@section('content')

<div class="product-info">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="product-title">{{{$product->name}}}</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-5">
                    <div class="image">
                        <p>
                            <img id="product_image" src="<?php echo $defaultImage->getAbsSrc();?>" height="268">
                        </p>
                    </div>
                    <div class="image-additional">
                        <?php foreach($images as $img){?>
                        <a onclick="replaceImg('<?php echo $img->getAbsSrc()?>');" >
                            <img src="<?php echo $img->getAbsSrc()?>" height="65" width="65">
                        </a>
                        <?php } ?>
                    </div>
                </div>
                <div class="col-sm-7 product-shop">
                    <div class="row availability">
                        <span><?php echo trans('AVAILABILITY')?>:</span><?php echo ($product->quantity - $product->sold) > 0 ? trans('IN_STOCK'):trans('OUT_OF_STOCK')?>
                    </div>
                    <div class="row price-box">
                        <span class="price"><?php echo \Goxob\Core\Helper\Data::formatPrice($product->price);?></span>
                    </div>
                    <?php if(!empty($product->short_description)){?>
                    <div class="row short-description">
                        <label>{{trans('QUICK_OVERVIEW')}}</label>
                        <div class="std">
                            {{$product->short_description}}
                        </div>
                    </div>
                    <?php }?>

                    <?php if($product->quantity - $product->sold > 0){?>
                    <div class="row add-to-cart">
                        <div class="col-md-12">
                            <?php echo Form::open(array('class' => 'form-horizontal', 'url' => 'cart/add', 'id' => 'add-cart-form'))?>
                                <label>Qty:</label>
                                <input type="text" name="quantity" size="2" value="1" class="qty required">
                                <input type="hidden" name="product_id" value="{{$product->product_id}}" id="product_id">
                                <input type="submit" value="Add to Cart" id="button-cart" class="btn btn-primary btn-sm">
                            <?php echo Form::close();?>
                        </div>
                    </div>
                    <?php } ?>

                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div>
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab-description" data-toggle="tab">{{trans('Description')}}</a></li>
                            <li class=""><a href="#tab-attribute" data-toggle="tab">{{trans('Specification')}}</a></li>
                            <li class=""><a href="#tab-review" data-toggle="tab">{{trans('Reviews')}}</a></li>
                            @if(count($relatedProducts)>0)
                            <li class=""><a href="#tab-related" data-toggle="tab">{{trans('Related Products')}}</a></li>
                            @endif
                        </ul>
                        <div class="tab-content">

                            <div class="tab-pane active" id="tab-description">
                                {{$product->description}}
                            </div>

                            <div class="tab-pane" id="tab-attribute" style="min-height: 400px;">
                                @include('catalog.product.info.attribute')
                            </div>

                            <div id="tab-review" class="tab-pane">
                                @include('catalog.product.info.review')
                            </div>

                            @if(count($relatedProducts)>0)
                            <div id="tab-related" class="tab-pane">
                                @block('catalog/product-block', array('collection' => $relatedProducts, 'cols' => 4))
                            </div>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery('#add-cart-form').validate();
    });
    $(window).load(function(){
        makeZoomer();
    });

    function makeZoomer()
    {
        jQuery('#product_image').addimagezoom({
            zoomrange: [3, 10],
            magnifiersize: [300,300],
            magnifierpos: 'right',
            cursorshade: true
        });
    }

    function replaceImg(src)
    {
        document.getElementById('product_image').src = src;
        makeZoomer();
    }
</script>

@stop