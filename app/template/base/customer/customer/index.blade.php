@extends('master.customer')

@section('content')

    <h2>Account Information</h2>

    <?php echo Form::model($customer, array('class' => 'form-horizontal', 'id' => 'account-form', 'url' => 'customer/save-account'))?>

    <?php echo Form::row('text', 'First Name', 'first_name', null, array('required' => true));?>

    <?php echo Form::row('text', 'Last Name', 'last_name', null, array('required' => true));?>

    <?php echo Form::row('password', 'Password', 'password');?>

    <?php echo Form::row('password', 'Password Confirm', 'password_confirm');?>

    <?php echo Form::row('text', 'Phone', 'phone');?>

    <?php echo Form::row('text', 'Birth Date', 'birthday', \Goxob\Core\Helper\Data::formatDate($customer->birthday) , array('class'=>'datepicker'));?>

    <?php echo Form::row('dropdown', 'Gender', 'gender', $customer->status, null,
        array(
            'collection' => array(1 => 'Male' , 0 => 'Female')
        ),
        'col-sm-2'
    );?>

    <?php echo Form::row('hidden', '', 'customer_id', $customer->customer_id, array('id' => 'customer_id'));?>

    <div class="col-sm-12 text-right">
        <input type="submit" name="submit" class="btn btn-primary" value="Save">
    </div>

    <?php echo Form::close();?>

<script>
    $(document).ready(function(){
        $('#account-form').validate();

        $('.datepicker').datetimepicker();
    });
</script>


@stop