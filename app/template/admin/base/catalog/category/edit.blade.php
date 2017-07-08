@extends('master.main')


@section('content')
<?php echo Form::model($item, array('name' => 'adminForm', 'class' => 'form-horizontal', 'url' => 'admin/catalog/category/store'))?>

<?php echo Form::row('text', 'Name', 'name', null, array('required' => true));?>

<?php echo Form::row('text', 'Alias', 'alias');?>

<?php echo Form::row('dropdown', 'Parent Category', 'parent_id', $item->parent_id, null,
    array(
        'collection' =>  \Goxob::getModel('catalog/categories')->getChildren(),
        'field_value' => 'category_id',
        'field_name' => 'name',
        'extraOptions' => array(
            '0' => 'Root'
        )
    )
);?>

<?php echo Form::row('hidden', '', 'category_id', $item->category_id, array('id' => 'category_id'));?>


<?php echo Form::close();?>

@stop