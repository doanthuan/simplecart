<?php echo Form::open(array('url' => 'products/post-search', 'class' => 'form-search', 'autocomplete' => 'off')) ?>
    <div class="input-group">
        <input type="text" class="form-control" placeholder="Search" name="product_search" id="product_search" value="{{{Input::get('search')}}}">
        <div class="input-group-btn">
            <button class="btn btn-default" type="submit">
                <i class="glyphicon glyphicon-search"></i>
            </button>
        </div>
    </div>
<?php echo Form::close();?>
<script src="{{url('media/bootstrap/js/bootstrap3-typeahead.min.js')}}"></script>
<script>
    $(document).ready(function(){
        $('#product_search').typeahead({
            source: function (query, process) {
                getProductSource(query, process)
            }
        });
    });
</script>