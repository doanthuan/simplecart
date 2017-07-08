@extends('master.main')


@section('content')
<?php echo Form::model($item, array('name' => 'adminForm', 'class' => 'form-horizontal', 'url' => 'admin/slideshow/group/store'))?>

<?php echo Form::row('text', 'Name', 'name', null, array('required' => true));?>

<?php echo Form::row('text', 'Alias', 'alias');?>

<?php echo Form::row('hidden', '', 'group_id', $item->group_id, array('id' => 'group_id'));?>

<?php echo Form::close();?>

@stop