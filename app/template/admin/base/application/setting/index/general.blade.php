
<?php echo Form::row('text', 'Store Name', 'store[store_name]');?>

<?php echo Form::row('text', 'Homepage Title', 'store[store_title]');?>

<?php echo Form::row('textarea', 'Meta Description', 'store[meta_desc]', null, array('rows' => 5));?>

<?php echo Form::row('text', 'Admin Email', 'store[admin_email]');?>

<?php echo Form::row('text', 'Phone', 'store[phone]');?>

<?php echo Form::row('text', 'Address', 'store[address]', null, array('rows' => 5));?>
