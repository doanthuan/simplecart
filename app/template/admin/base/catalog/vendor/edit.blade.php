@extends('master.main')

@section('content')
<?php echo Form::model($item, array('name' => 'adminForm', 'class' => 'form-horizontal', 'url' => 'admin/catalog/vendor/store'))?>

<?php echo Form::row('text', 'Vendor Name', 'vendor_name', null, array('required' => true));?>

<?php echo Form::row('text', 'Country', 'country');?>

<?php echo Form::row('text', 'Url', 'url', null, array('url' => true));?>

<?php echo Form::row('text', 'Email', 'email', null, array('email' => 'true'));?>

<?php echo Form::row('textarea', 'Description', 'description');?>

<?php echo Form::row('hidden', '', 'vendor_id', $item->vendor_id);?>

<?php echo Form::close();?>

@stop