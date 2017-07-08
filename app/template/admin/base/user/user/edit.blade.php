@extends('master.main')

@section('content')
<?php echo Form::model($item, array('name' => 'adminForm', 'class' => 'form-horizontal', 'url' => 'admin/user/user/store'))?>

<?php echo Form::row('text', 'User Name', 'username', null, array('required' => true));?>

<?php echo Form::row('text', 'First Name', 'first_name');?>

<?php echo Form::row('text', 'Last Name', 'last_name');?>

<?php echo Form::row('text', 'Email', 'email', null, array('required' => true, 'email' => true));?>

<?php
$pswRequired = isset($item->user_id)?array():array('required' => true);
?>
<?php echo Form::row('password', 'Password', 'password', null, $pswRequired);?>

<?php echo Form::row('password', 'Password Confirm', 'password_confirm', null, $pswRequired);?>

<?php echo Form::row('dropdown', 'Role', 'role_id', $item->role_id, null,
    array(
        'collection' => \Goxob::getModel('user/roles')->getAll(),
        'field_value' => 'role_id',
        'field_name' => 'role_name'
    )
);?>

<?php echo Form::row('dropdown', 'Status', 'status', $item->status, null,
    array(
        'collection' => array(1 => 'Enable' , 0 => 'Disable')
    ),
    'col-sm-2'
);?>

<?php echo Form::row('hidden', '', 'user_id', $item->customer_id, array('id' => 'user_id'));?>

<?php echo Form::close();?>


<script type="text/javascript">

    jQuery('form[name="adminForm"]').validate({
        rules : {
            password : {
                minlength : 5
            },
            password_confirm : {
                minlength : 5,
                equalTo : "#password"
            }
        }
    });

</script>



@stop