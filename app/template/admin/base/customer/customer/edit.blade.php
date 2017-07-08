@extends('master.main')

@section('head')
@parent
<link rel="stylesheet" href="{{url('media/bootstrap/css/bootstrap-datetimepicker.css')}}" type="text/css" media="all" />
<script src="{{url('media/bootstrap/js/moment.js')}}"></script>
<script src="{{url('media/bootstrap/js/bootstrap-datetimepicker.js')}}"></script>
@stop

@section('content')
<?php echo Form::model($item, array('name' => 'adminForm', 'class' => 'form-horizontal', 'url' => 'admin/customer/customer/store'))?>

<?php echo Form::row('text', 'First Name', 'first_name', null, array('required' => true));?>

<?php echo Form::row('text', 'Last Name', 'last_name', null, array('required' => true));?>

<?php echo Form::row('text', 'Email', 'email', null, array('required' => true, 'email' => true));?>

<?php
$pswRequired = isset($item->customer_id)?array():array('required' => true);
?>
<?php echo Form::row('password', 'Password', 'password', null, $pswRequired);?>

<?php echo Form::row('password', 'Password Confirm', 'password_confirm', null, $pswRequired);?>

<?php echo Form::row('text', 'Phone', 'phone');?>

<?php echo Form::row('text', 'Birth Date', 'birthday', null, array('class'=>'datepicker'));?>

<?php echo Form::row('dropdown', 'Gender', 'gender', $item->status, null,
    array(
        'collection' => array(1 => 'Male' , 0 => 'Female'),
    ),
    'col-sm-2'
);?>

<?php echo Form::row('dropdown', 'Status', 'status', $item->status, null,
    array(
        'collection' => array(1 => 'Enable' , 0 => 'Disable')
    ),
    'col-sm-2'
);?>

<?php echo Form::row('hidden', '', 'customer_id', $item->customer_id, array('id' => 'customer_id'));?>

<?php echo Form::close();?>


<script type="text/javascript">
    $(function () {
        $('.datepicker').datetimepicker();
    });

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