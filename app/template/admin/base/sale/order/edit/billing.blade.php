
<?php echo Form::row('text', 'First Name', 'billing_first_name', null, array('required' => true));?>

<?php echo Form::row('text', 'Last Name', 'billing_last_name', null, array('required' => true));?>

<?php echo Form::row('text', 'Phone', 'billing_phone');?>

<?php //echo Form::row('text', 'Company', 'billing_company');?>

<?php echo Form::row('text', 'Address', 'billing_address', null, array('required' => true));?>

<?php echo Form::row('text', 'City', 'billing_city', null, array('required' => true));?>

<?php echo Form::row('text', 'State', 'billing_state');?>

<?php echo Form::row('text', 'Zip Code', 'billing_zipcode');?>
