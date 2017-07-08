<div class="col-md-12">

    <div id="review">
        <?php if(count($reviews) > 0){
            foreach($reviews as $review){
            ?>
                <div class="review-list">
                    <div class="author"><b>{{$review->author}}</b>  on  {{$review->created_at}}</div>
                    <div class="rating"><img src="{{url('skin/base/images').'/stars-'.$review->rating.'.png'}}" alt="1 reviews"></div>
                    <div class="text">{{$review->description}}</div>
                </div>
            <?php } ?>

            <div class="row">
                <div class="col-md-6 col-md-offset-6 text-right">
                    <div class="row">
                        <div class="col-md-8">{{$reviews->links()}}</div>
                        <div class="col-md-4"><span><?php echo $reviews->getTotal(); ?> {{trans('Review(s)')}}</span></div>
                    </div>
                </div>
            </div>

        <?php } else { ?>
        <div class="content">There are no reviews for this product.</div>
        <?php } ?>
    </div>
    <br>
    <br>
    <h2 id="review-title">Write a review</h2><hr>


    <?php echo Form::open(array('class' => 'form-horizontal', 'url' => 'product/post-review', 'id' => 'review-form'))?>

        <?php echo Form::row('text', 'Your Name', 'author', null, array('required' => true));?>

        <?php echo Form::row('textarea', 'Description', 'description', null, array('required' => true));?>

        <div class="form-group">
            <label for="rating" class="col-sm-2 control-label">{{trans('Rating')}}</label>
            <div class="col-sm-10">
                <span><b>Bad</b></span>&nbsp;&nbsp;
                <?php echo Form::radio('rating',1); ?>&nbsp;&nbsp;
                <?php echo Form::radio('rating',2); ?>&nbsp;&nbsp;
                <?php echo Form::radio('rating',3); ?>&nbsp;&nbsp;
                <?php echo Form::radio('rating',4); ?>&nbsp;&nbsp;
                <?php echo Form::radio('rating',5); ?>&nbsp;&nbsp;
                <span><b>Good</b></span>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label" for="phone">{{trans('Captcha')}}</label>
            <div class="col-sm-10">
                <?php echo Form::text('captcha', null, array('class' => 'form-control required', 'placeholder' => ''))?>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-10 col-sm-offset-2">
                <?php echo HTML::image(Captcha::img(), 'Captcha image');?>
            </div>
        </div>

        <br><br>
        <div class="form-group">
            <div class="col-sm-10 col-sm-offset-2">
                <input type="submit" class="btn btn-sm btn-primary" value="{{trans('Submit')}}">
            </div>
        </div>

    <input type="hidden" name="product_id" value="{{$product->product_id}}">

    <?php echo Form::close();?>
</div>

<script>
    $(document).ready(function(){
        $('#review-form').validate();

        var url = document.location.toString();
        if (url.match('#')) {
            $('.nav-tabs a[href=#'+url.split('#')[1]+']').tab('show') ;
        }

        // Change hash for page-reload
        $('.nav-tabs a').on('shown', function (e) {
            window.location.hash = e.target.hash;
        })
    });

</script>