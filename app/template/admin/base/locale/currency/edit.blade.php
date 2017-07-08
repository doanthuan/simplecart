@extends('master.main')

@section('content')
<?php echo Form::model($item, array('name' => 'adminForm', 'class' => 'form-horizontal', 'url' => 'admin/locale/currency/store'))?>

<?php echo Form::row('text', 'Title', 'title', null, array('required' => true));?>

<?php echo Form::row('text', 'Code', 'code');?>

<?php echo Form::row('text', 'Symbol Left', 'symbol_left');?>

<?php echo Form::row('text', 'Symbol Right', 'symbol_right');?>

<?php echo Form::row('text', 'Decimal Place', 'decimal_place');?>

<?php echo Form::row('text', 'Value', 'value');?>

<?php echo Form::row('dropdown', 'Status', 'status', $item->status, null,
    array(
        'collection' => array(1 => 'Enable' , 0 => 'Disable')
    ),
    'col-sm-2'
);?>

<?php echo Form::row('dropdown', 'Default', 'default', $item->default, null,
    array(
        'collection' => array(1 => 'True' , 0 => 'False')
    ),
    'col-sm-2'
);?>


<?php echo Form::row('hidden', '', 'currency_id', $item->currency_id, array('id' => 'currency_id'));?>

<?php echo Form::close();?>

@stop