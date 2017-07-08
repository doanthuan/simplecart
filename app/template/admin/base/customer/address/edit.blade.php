@extends('master.main')

@section('head')
@parent
<script src="{{url('media/bootstrap/js/bootstrap3-typeahead.min.js')}}"></script>
@stop

@section('content')
<?php echo Form::model($item, array('name' => 'adminForm', 'class' => 'form-horizontal', 'url' => 'admin/customer/address/store',
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

<?php echo Form::row('dropdown', 'Country', 'country', $item->country, null,
    array(
        'collection' => \Goxob\Core\Helper\Data::getCountryList()
    )
);?>

<?php echo Form::row('dropdown', 'Address Type', 'type', $item->type, null,
    array(
        'collection' => array(0 => 'Billing Address' , 1 => 'Shipping Address')
    )
);?>

<?php echo Form::row('text', 'Customer', 'customer_name', null, array('required' => true, 'id' => 'customer_name'));?>

<?php echo Form::row('hidden', '', 'address_id', $item->address_id, array('id' => 'address_id'));?>

<?php echo Form::row('hidden', '', 'customer_id', $item->customer_id, array('id' => 'customer_id'));?>

<?php echo Form::close();?>

<script>
    $(document).ready(function(){
        customerSuggestion('customer_name', 'customer_id');
    });
</script>


@stop