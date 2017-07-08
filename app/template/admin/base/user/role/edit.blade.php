@extends('master.main')

@section('content')
<?php echo Form::model($item, array('name' => 'adminForm', 'class' => 'form-horizontal', 'url' => 'admin/user/role/store'))?>

<?php echo Form::row('text', 'Role Name', 'role_name', null, array('required' => true));?>

<?php echo Form::row('text', 'Permission', 'permission');?>

<?php echo Form::row('hidden', '', 'role_id');?>

<?php echo Form::close();?>

@stop