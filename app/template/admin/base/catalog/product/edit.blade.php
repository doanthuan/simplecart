@extends('master.main')

@section('head')
@parent
<link rel="stylesheet" href="{{url('media/bootstrap/css/bootstrap-datetimepicker.css')}}" type="text/css" media="all" />
<script src="{{url('media/bootstrap/js/moment.js')}}"></script>
<script src="{{url('media/bootstrap/js/bootstrap-datetimepicker.js')}}"></script>
<script src="{{url('media/system/js/tinymce/tinymce.min.js')}}"></script>
@stop



@section('content')
<?php echo Form::model($item, array('name' => 'adminForm', 'class' => 'form-horizontal', 'url' => 'admin/catalog/product/store', 'files' => true))?>

<ul class="nav nav-tabs" id="myTab">
    <li class="active"><a href="#general" data-toggle="tab">{{trans('General')}}</a></li>
    <li><a href="#images" data-toggle="tab">{{trans('Images')}}</a></li>
    <li><a href="#attributes" data-toggle="tab">{{trans('Attributes')}}</a></li>
    <li><a href="#related" data-toggle="tab">{{trans('Related Products')}}</a></li>
    <li><a href="#extras" data-toggle="tab">{{trans('Extras')}}</a></li>
</ul>
<div class="tab-content">
    <div class="tab-pane fade in active" id="general">
        @include('catalog.product.edit.general')
    </div>

    <div class="tab-pane fade" id="images">
        @include('catalog.product.edit.images')
    </div>

    <div class="tab-pane fade" id="attributes">
        <fieldset id="product_options">

        </fieldset>
    </div>

    <div class="tab-pane fade" id="related">
        @include('catalog.product.edit.related')
    </div>

    <div class="tab-pane fade" id="extras">
        @include('catalog.product.edit.extras')
    </div>

</div>

<?php echo Form::close();?>

<script>
    jQuery(document).ready(function(){
        //load product properties when load edit form
        var attr_set_id = jQuery('#attr_set_id').val();
        if(attr_set_id > 0){
            changeProductOptions('<?php echo url('admin/catalog/product/get-attributes');?>');
        }

        initMCE('textarea');

    });

    function changeProductOptions(url)
    {
        var attr_set_id = jQuery('#attr_set_id').val();
        var product_id = jQuery('#product_id').val();
        jQuery
            .get(
            url,
            {
                'attr_set_id' : attr_set_id,
                'product_id' : product_id
            }, function(data) {
                jQuery('#product_options').html(data);
            });
    }

    function showCreateVendor()
    {
        var vendor_id = jQuery('#vendor_id').val();
        var html = '<div class="col-sm-5" id="vendor-name-row"><input type="text" name="vendor_name" id="vendor_name"class="form-control"></div>';
        if(vendor_id == 0){
            jQuery('#vendor_id').parent().parent().append(html);
        }
        else{
            jQuery('#vendor-name-row').remove();
        }
    }

</script>
@stop