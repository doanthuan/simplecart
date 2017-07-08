<div class="form-group">
    <label class="col-sm-2 control-label">{{trans('Related Products')}}</label>
    <div class="col-sm-10">
        @block('catalog/product-suggestion-list', array('products' => isset($relatedProducts)?$relatedProducts:null ))
    </div>
</div>
