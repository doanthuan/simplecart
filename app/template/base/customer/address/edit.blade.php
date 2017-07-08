@extends('master.customer')

@section('content')
<?php echo Form::model($address, array('class' => 'form-horizontal', 'url' => 'customer/address/store',
    'autocomplete' => 'off'))?>

<?php echo Form::row('text', 'First Name', 'first_name', null, array('required' => true));?>

<?php echo Form::row('text', 'Last Name', 'last_name', null, array('required' => true));?>

<?php echo Form::row('text', 'Phone', 'phone');?>

<?php echo Form::row('text', 'Company', 'company');?>

<?php echo Form::row('text', 'Fax', 'fax');?>

<?php echo Form::row('text', 'Address', 'address', null, array('required' => true));?>

<?php echo Form::row('text', 'City', 'city');?>

<?php echo Form::row('text', 'State', 'state');?>

<?php echo Form::row('text', 'Zipcode', 'zipcode');?>

<div class="form-group">
    <div class="col-md-10 col-md-offset-2">
        <input type="submit" class="btn btn-primary" value="{{trans('Submit')}}">
    </div>
</div>

<input type="hidden" name="type" value="{{$address->type}}">
<input type="hidden" name="address_id" value="{{$address->address_id}}">
<input type="hidden" name="customer_id" value="{{$address->customer_id}}">

<?php echo Form::close();?>


@stop