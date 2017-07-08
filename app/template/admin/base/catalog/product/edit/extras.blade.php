
<?php echo Form::row('textarea', 'Description', 'description');?>

<?php echo Form::row('text', 'Published Date', 'published_date', null, array('class'=>'datepicker'));?>

<?php echo Form::row('text', 'New From', 'new_from', null, array('class'=>'datepicker'));?>

<?php echo Form::row('text', 'New To', 'new_to', null, array('class'=>'datepicker'));?>

<?php echo Form::row('text', 'Hot From', 'hot_from', null, array('class'=>'datepicker'));?>

<?php echo Form::row('text', 'Hot To', 'hot_to', null, array('class'=>'datepicker'));?>

<?php echo Form::row('text', 'Old Price', 'old_price');?>


<script type="text/javascript">
    $(function () {
        $('.datepicker').datetimepicker();
    });
</script>