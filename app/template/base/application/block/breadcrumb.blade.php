<?php if(count($items) > 0){?>
<div class="row">
    <div class="col-md-12">
        <div class="breadcrumb">
                <a href="{{url()}}">{{trans('Home')}}</a> &gt;&gt;
            <?php foreach($items as $i => $item){?>
                <?php if(isset($item->category_id)){ ?>
                    <a href="<?php echo \Goxob\Catalog\Helper\Category::getLink($item->category_id)?>"><?php echo $item->name?></a>
                <?php }else{
                    echo $item->name;
                }?>
                <?php if($i < count($items) -1 ){?>
                        &gt;&gt;
                <?php }?>
            <?php }?>
        </div>
    </div>
</div>
<?php }?>