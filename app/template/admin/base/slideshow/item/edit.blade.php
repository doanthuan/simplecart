@extends('master.main')


@section('content')
<?php echo Form::model($item, array('name' => 'adminForm', 'class' => 'form-horizontal', 'url' => 'admin/slideshow/item/store', 'files' => true))?>

<?php echo Form::row('text', 'Name', 'name', null, array('required' => true));?>

<?php echo Form::row('file', 'Image', 'image');?>

<?php echo Form::row('text', 'Link To', 'link_to');?>

<?php echo Form::row('dropdown', 'Group', 'group_id', $item->group_id, null,
    array(
        'collection' =>  \Goxob::getModel('slideshow/groups')->getAll(),
        'field_value' => 'group_id',
        'field_name' => 'name'
    )
);?>

<?php echo Form::row('text', 'Sort Order', 'sort_order');?>

<?php echo Form::row('hidden', '', 'item_id', $item->item_id, array('id' => 'item_id'));?>

<?php echo Form::close();?>

@stop