
<?php echo Form::row('text', 'First Name', 'shipping_first_name', null, array('required' => true));?>

<?php echo Form::row('text', 'Last Name', 'shipping_last_name', null, array('required' => true));?>

<?php echo Form::row('text', 'Phone', 'shipping_phone');?>

<?php //echo Form::row('text', 'Company', 'shipping_company');?>

<?php echo Form::row('text', 'Address', 'shipping_address', null, array('required' => true));?>

<?php echo Form::row('text', 'City', 'shipping_city', null, array('required' => true));?>

<?php echo Form::row('text', 'State', 'shipping_state');?>

<?php echo Form::row('text', 'Zip Code', 'shipping_zipcode');?>
