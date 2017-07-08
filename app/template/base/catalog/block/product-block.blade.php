<?php if(isset($paginate)){?>
    <div class="row pagination-row">
        <div class="col-md-9">
            <strong>@lang('View As'):</strong>
            <?php if(!Input::has('mode') || Input::get('mode') =='grid'){?>
                {{trans('Grid')}}
                <span> / </span>
                <a href="<?php echo \Goxob\Core\Helper\Data::currentUrl(array('mode' => 'list'))?>">{{trans('List')}}</a>
            <?php } elseif (Input::has('mode') && Input::get('mode') == 'list'){ ?>
                <a href="<?php echo \Goxob\Core\Helper\Data::currentUrl(array('mode' => 'grid'))?>">{{trans('Grid')}}</a>
                <span> / </span>
                {{trans('List')}}
            <?php }?>
        </div>
        <div class="col-md-3 text-right">
            <strong>{{trans('Sort By')}}:</strong>
            <?php echo $block->orderByDropdown();?>
        </div>
    </div>
<?php }?>

<?php if(isset($title)){?>
<div class="panel panel-default">
    <div class="panel-heading">
        <?php echo $title;?>
    </div>
    <div class="panel-body">
<?php } ?>

        <?php if(!Input::has('mode') || Input::get('mode') =='grid'){?>
            @include('catalog.block.product-grid')
        <?php } elseif (Input::has('mode') && Input::get('mode') == 'list'){ ?>
            @include('catalog.block.product-list')
        <?php }?>

<?php if(isset($title)){?>
    </div>
</div>
<?php } ?>



<?php if(isset($paginate)){?>
    <div class="row pagination-row">
        <div class="col-md-9">
            {{$products->links()}}
        </div>
        <div class="col-md-3 text-right">
            <strong>{{trans('Display')}}:</strong>
            <?php echo \Goxob\Core\Helper\Html::paginateLimitBox(); ?>
        </div>
    </div>
<?php }?>