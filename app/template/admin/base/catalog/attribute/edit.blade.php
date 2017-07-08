@extends('master.main')

@section('content')
<?php echo Form::model($item, array('name' => 'adminForm', 'class' => 'form-horizontal', 'url' => 'admin/catalog/attribute/store'))?>

<?php
if($item->code){
    echo Form::row('text', 'Code', 'code', null, array('required' => true, 'disabled' => 'disabled'));
}else{
    echo Form::row('text', 'Code', 'code', null, array('required' => true));
}
?>

<?php echo Form::row('text', 'Label', 'label', null, array('required' => true));?>

<?php echo Form::row('dropdown', 'Attribute Set', 'attr_set_id', $item->attr_set_id, null,
    array(
        'collection' => \Goxob::getModel('catalog/attribute-sets')->getAll(),
        'field_value' => 'attr_set_id',
        'field_name' => 'name'
    )
);?>


<?php echo Form::row('dropdown', 'Type', 'type', $item->type, array('id' => 'attribute_type'),
    array(
        'collection' => \Goxob\Catalog\Helper\Attribute::getTypeList()
    )
);?>


<div class="form-group" id="options-row">
    <label for="label" class="col-sm-2 control-label">{{trans('Options')}}</label>
    <div class="col-sm-10">
        <?php echo Form::textarea('options', null, array('rows' => 5, 'cols' => 100, 'placeholder' => 'Red; Green; Blue'));?>
        <p class="help-block">{{trans('Separate by semicolon')}} (;).</p>
    </div>
</div>


<?php echo Form::row('hidden', '', 'attr_id', $item->attribute_id, array('id' => 'attr_id'));?>


<?php echo Form::close();?>

<script type="text/javascript">
    $(document).ready(function(){
        showHideOptions();
        $("#attribute_type").change( function () {
            showHideOptions();
        });
    })
    function showHideOptions(){
        var typeId = $('#attribute_type>option:selected').val()

        $("#options-row").hide();
        if(typeId == {{\Goxob\Catalog\Helper\Attribute::TYPE_DROPDOWN}}
        || typeId == {{\Goxob\Catalog\Helper\Attribute::TYPE_MULTISELECT}}
        || typeId == {{\Goxob\Catalog\Helper\Attribute::TYPE_MULTIRADIO}}
        ){
            $("#options-row").show();
        }

    }
</script>

@stop