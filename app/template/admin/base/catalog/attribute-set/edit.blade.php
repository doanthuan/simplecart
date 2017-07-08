@extends('master.main')


@section('content')
<?php echo Form::model($item, array('name' => 'adminForm', 'class' => 'form-horizontal', 'url' => 'admin/catalog/attribute-set/store'))?>

<?php echo Form::row('text', 'Name', 'name', null, array('required' => true));?>

<?php echo Form::row('hidden', '', 'attr_set_id', $item->attr_set_id, array('id' => 'attr_set_id'));?>

<?php echo Form::close();?>

@stop