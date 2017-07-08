@extends('master.main')

@section('head')
@parent
<script src="{{url('media/system/js/tinymce/tinymce.min.js')}}"></script>
@stop


@section('content')
<?php echo Form::model($item, array('name' => 'adminForm', 'class' => 'form-horizontal', 'url' => 'admin/cms/content/store', 'files' => true))?>

<?php echo Form::row('text', 'Title', 'title', null, array('required' => true));?>

<?php echo Form::row('text', 'Alias', 'alias');?>

<?php echo Form::row('textarea', 'Content', 'content');?>

<?php echo Form::row('dropdown', 'Category', 'category_id', $item->category_id, null,
    array(
        'collection' =>  \Goxob::getModel('cms/categories')->getAll(),
        'field_value' => 'category_id',
        'field_name' => 'name'
    )
);?>

<?php echo Form::row('file', 'Thumbnail', 'thumbnail');?>

<?php echo Form::row('text', 'Sort Order', 'sort_order');?>

<?php echo Form::row('dropdown', 'Status', 'status', $item->status, null,
    array(
        'collection' => array(1 => 'Enable' , 0 => 'Disable')
    ),
    'col-sm-2'
);?>


<?php echo Form::row('hidden', '', 'content_id', $item->content_id, array('id' => 'content_id'));?>

<?php echo Form::close();?>

<script>
    jQuery(document).ready(function(){
        initMCE('textarea');
    });
</script>

@stop