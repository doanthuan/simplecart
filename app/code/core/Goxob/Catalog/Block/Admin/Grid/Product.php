<?php
namespace Goxob\Catalog\Block\Admin\Grid;

use Goxob\Core\Block\Grid;

class Product extends Grid{

    protected function prepareCollection()
    {
        $model = \Goxob::getModel('catalog/products')->join(array('category','attribute_set'));
        $items = $this->getData($model);

        return $items;
    }

    protected function prepareColumns()
    {
        $this->addColumn(array(
            'name' => 'product_id',
            'header' => trans('ID'),
            'key' => true,
            'filter_type' => 'range'
        ));

        $this->addColumn(array(
            'name' => 'name',
            'header' => trans('Name'),
            'filter_type' => 'text'
        ));

        $this->addColumn(array(
            'name' => 'sku',
            'header' => trans('SKU'),
            'filter_type' => 'text'
        ));

        $this->addColumn(array(
            'name' => 'price',
            'header' => trans('Price'),
            'filter_type' => 'range',
            'renderer' => new \Goxob\Catalog\Block\Admin\Grid\Renderer\ProductPrice()
        ));

        $this->addColumn( array(
            'name' => 'quantity',
            'header' => trans('Quantity'),
            'filter_type' => 'range'
        ));

        $this->addColumn( array(
            'name' => 'category_name',
            'header' => trans('Category'),
            'filter_type' => 'dropdown',
            'filter_index' => 'category_id',
            'filter_data' => array(
                'collection' => \Goxob::getModel('catalog/categories')->getChildren(),
                'field_value' => 'category_id',
                'field_name' => 'name',
                'extraOptions' => array('' => trans('- Please Select -'))
            )
        ));

        $this->addColumn(array(
            'name' => 'attribute_set_name',
            'header' => trans('Attribute Set'),
            'filter_type' => 'dropdown',
            'filter_index' => 'attr_set_id',
            'filter_data' => array(
                'collection' => \Goxob::getModel('catalog/attribute-sets')->getAll(),
                'field_value' => 'attr_set_id',
                'field_name' => 'name',
                'extraOptions' => array('' => trans('- Please Select -'))
            )
        ));

        $this->addColumn(array(
            'name' => 'status',
            'header' => trans('Status'),
            'published' => true,
        ));
    }
}