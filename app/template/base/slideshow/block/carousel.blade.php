@section('head')
@parent
<link rel="stylesheet" href="{{url('skin/base/css/slideshow.css')}}" type="text/css" media="all" />
@stop

<div class="row">
<div class="col-sm-12">
    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
            <li data-target="#carousel-example-generic" data-slide-to="1"></li>
            <li data-target="#carousel-example-generic" data-slide-to="2"></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner">
            <?php foreach($items as $i => $item){?>
            <div class="item <?php echo $i == 0?'active':'';?>">
                <img src="<?php echo \Goxob::getBaseUrl('media').'/slideshow/'.$item->image;?>">
            </div>
            <?php } ?>
        </div>

        <!-- Controls -->
<!--        <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">-->
<!--            <span class="glyphicon glyphicon-chevron-left"></span>-->
<!--        </a>-->
<!--        <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">-->
<!--            <span class="glyphicon glyphicon-chevron-right"></span>-->
<!--        </a>-->
    </div>
</div>
</div>