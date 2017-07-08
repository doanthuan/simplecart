@extends('master.main')

@section('content')
<?php echo Form::open(array('name' => 'adminForm', 'class' => 'form-horizontal', 'url' => 'admin/catalog/product/post-import', 'files' => true))?>

<?php echo Form::row('file', 'Import File', 'import_file', null, array('required' => true));?>

<?php echo Form::close();?>

@stop