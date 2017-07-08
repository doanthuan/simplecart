@extends('master.main')

@section('head')
@parent
<link rel="stylesheet" href="{{url('media/bootstrap/css/bootstrap-datetimepicker.css')}}" type="text/css" media="all" />
<script src="{{url('media/bootstrap/js/moment.js')}}"></script>
<script src="{{url('media/bootstrap/js/bootstrap-datetimepicker.js')}}"></script>
@stop

@section('content')
<?php echo Form::model($item, array('name' => 'adminForm', 'class' => 'form-horizontal', 'url' => 'admin/coupon/coupon/store'))?>

<?php echo Form::row('text', 'Name', 'name', null, array('required' => true));?>

<?php echo Form::row('text', 'Code', 'code', null, array('required' => true));?>

<?php echo Form::row('dropdown', 'Type', 'type', $item->type, null,
    array(
        'collection' => array( 'P' => trans('Percentage') , 'F' => 'Fixed Amount')
    ),
    'col-sm-2'
);?>

<?php echo Form::row('text', 'Discount', 'discount', null, array('required' => true));?>

<?php echo Form::row('dropdown', 'Free Shipping', 'free_shipping', $item->free_shipping, null,
    array(
        'collection' => array( 1 => 'Yes' , 0 => 'No')
    ),
    'col-sm-2'
);?>

<div class="form-group">
    <label for="total_above" class="col-sm-2 control-label">{{trans('Total Above')}}</label>
    <div class="col-sm-10"><?php echo Form::text('total_above', null , array('class' => 'form-control' ));?>
        <p class="help-block">{{trans('The total amount that must reached before the coupon is valid')}}.</p>
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label">{{trans('Products')}}</label>
    <div class="col-sm-10">
        @block('catalog/product-suggestion-list', array('products' => isset($relatedProducts)?$relatedProducts:null ))
        <p class="help-block">{{trans('Choose specific products the coupon will apply to. Select no products to apply coupon to entire cart.')}}</p>
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label">{{trans('Categories')}}</label>
    <div class="col-sm-10">
        @block('catalog/category-suggestion-list', array('categories' => isset($relatedProducts)?$relatedProducts:null ))
        <p class="help-block">{{trans('Choose all products under selected category.')}}</p>
    </div>
</div>

<?php echo Form::row('text', 'Date Start', 'date_start', null, array('class'=>'datepicker'));?>

<?php echo Form::row('text', 'Date End', 'date_end', null, array('class'=>'datepicker'));?>


<?php echo Form::row('dropdown', 'Status', 'status', $item->status, null,
    array(
        'collection' => array(1 => 'Enable' , 0 => 'Disable')
    ),
    'col-sm-2'
);?>

<?php echo Form::row('hidden', '', 'coupon_id', $item->coupon_id);?>

<?php echo Form::close();?>

<script type="text/javascript">
    $(function () {
        $('.datepicker').datetimepicker({
            pickTime: false,
            format: 'YYYY/MM/DD'
        });
    });
</script>

@stop