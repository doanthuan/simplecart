<?php if(count($contents) > 0){?>
<div class="content-list" style="padding: 0px 15px;">
    <?php foreach ($contents as $content) {?>
        <div class="row">
            <div class="col-sm-12 content">
                <div class="col-sm-3">
                    <div class="">
                        <img src="<?php echo \Goxob\Cms\Helper\Content::getThumbnail($content)?>" width="200px">
                    </div>
                </div>
                <div class="col-sm-9">
                    <h4><a href="<?php echo \Goxob\Cms\Helper\Content::getLink($content)?>">{{$content->title}}</a></h4>
                    <p class="blog-post-meta"><?php echo \Goxob\Core\Helper\Data::formatDateTime($content->updated_at)?></p>
                    <p><?php echo \Goxob\Cms\Helper\Content::getIntro($content)?></p>
                </div>
            </div>
        </div>
    <?php } ?>
</div>

<div class="row">
    <div class="col-md-12 text-center">
        {{$contents->links()}}
    </div>
</div>
<?php } ?>