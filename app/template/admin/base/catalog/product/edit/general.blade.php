<?php echo Form::row('text', 'Name', 'name', null, array('required' => true, 'placeholder' => trans('Enter Product Name')));?>

<?php echo Form::row('textarea', 'Short Description', 'short_description');?>

<div class="form-group">
    <label for="price" class="col-sm-2 control-label">{{trans('Price')}}</label>
    <div class="col-sm-10"><?php echo Form::text('price', \Goxob\Locale\Helper\Currency::getPrice($item->price) , array('class' => 'form-control' ));?>
        <p class="help-block">[<?php echo  strtoupper(\Goxob\Locale\Helper\Currency::getDefaultCurrencyCode());?>]</p>
    </div>
</div>

<div class="form-group">
    <label for="price" class="col-sm-2 control-label">{{trans('Cost')}}</label>
    <div class="col-sm-10"><?php echo Form::text('cost', \Goxob\Locale\Helper\Currency::getPrice($item->cost) , array('class' => 'form-control' ));?>
        <p class="help-block">[<?php echo strtoupper(\Goxob\Locale\Helper\Currency::getDefaultCurrencyCode());?>]</p>
    </div>
</div>


<?php echo Form::row('dropdown', 'Attribute Set', 'attr_set_id', $item->attr_set_id,
    array(
        'id' => 'attr_set_id',
        'onchange' => "changeProductOptions('".url('admin/catalog/product/get-attributes')."')"
    ),
    array(
        'collection' => \Goxob::getModel('catalog/attribute-sets')->getAll(),
        'field_value' => 'attr_set_id',
        'field_name' => 'name'
    )
);?>

<?php echo Form::row('dropdown', 'Category', 'category_id', $item->category_id, null,
    array(
        'collection' =>  \Goxob::getModel('catalog/categories')->getChildren(),
        'field_value' => 'category_id',
        'field_name' => 'name'
    )
);?>

<?php echo Form::row('text', 'SKU', 'sku');?>

<?php echo Form::row('text', 'Quantity', 'quantity');?>

<?php echo Form::row('text', 'Weight (kg)', 'weight');?>

<?php echo Form::row('dropdown', 'Vendor', 'vendor_id', $item->vendor_id, array(
        'id' => 'vendor_id',
        'onchange' => "showCreateVendor()"
    ),
    array(
        'collection' => \Goxob::getModel('catalog/vendors')->getAll(),
        'field_value' => 'vendor_id',
        'field_name' => 'vendor_name',
        'extraOptions' => array(
            '-1' => '------',
            '0' => 'Create Vendor....',
            'position' => 'bottom'
        )
    ),
    'col-sm-5'
);?>

<?php echo Form::row('dropdown', 'Status', 'status', $item->status, null,
    array(
        'collection' => array(1 => 'Enable' , 0 => 'Disable')
    ),
    'col-sm-2'
);?>

<?php echo Form::row('hidden', '', 'product_id', $item->product_id, array('id' => 'product_id'));?>