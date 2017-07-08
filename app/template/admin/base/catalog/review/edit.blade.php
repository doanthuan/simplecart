@extends('master.main')


@section('content')
<?php echo Form::model($item, array('name' => 'adminForm', 'class' => 'form-horizontal', 'url' => 'admin/catalog/review/store',
    'autocomplete' => 'off'))?>

<?php echo Form::row('text', 'Author', 'author', null, array('required' => true));?>

<?php echo Form::row('text', 'Product', 'product_name', isset($item->product)?$item->product->name:null, array('required' => true, 'id' => 'product_name'));?>

<?php echo Form::hidden('product_id', null, array('id' => 'product_id'));?>

<?php echo Form::row('text', 'Title', 'title', null, array('required' => true));?>

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


<?php echo Form::row('dropdown', 'Status', 'status', $item->status, null,
    array(
        'collection' => array(1 => 'Enable' , 0 => 'Disable')
    )
);?>


<?php echo Form::row('hidden', '', 'review_id', $item->review_id, array('id' => 'review_id'));?>


<?php echo Form::close();?>

<script src="{{url('media/bootstrap/js/bootstrap3-typeahead.min.js')}}"></script>
<script>
    $('#product_name').typeahead({
        source: function (query, process) {
            getProductSource(query, process);
        },
        updater: function (item) {
            var product_id = map[item].product_id;
            $('#product_id').val(product_id);
            return item;
        }
    });
</script>

@stop