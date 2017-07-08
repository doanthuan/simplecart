@extends('master.main')

@section('content')
<?php echo Form::model($item, array('name' => 'adminForm', 'class' => 'form-horizontal', 'url' => 'admin/cms/category/store'))?>

<?php echo Form::row('text', 'Name', 'name', null, array('required' => true));?>

<?php echo Form::row('text', 'Alias', 'alias');?>

<?php echo Form::row('hidden', '', 'category_id', $item->category_id, array('id' => 'category_id'));?>


<?php echo Form::close();?>

@stop