<?php
namespace Goxob\Catalog\Block\Admin\Grid;

use Goxob\Core\Block\Grid;

class Attribute extends Grid{

    protected function prepareCollection()
    {
        $model = \Goxob::getModel('catalog/attributes');
        $items = $this->getData($model);

        return $items;
    }

    protected function prepareColumns()
    {
        $this->addColumn(array(
            'name' => 'attr_id',
            'header' => trans('ID'),
            'key' => true,
            'filter_type' => 'range',
            'class' => "col-md-1"
        ));

        $this->addColumn(array(
            'name' => 'code',
            'header' => trans('Code'),
            'filter_type' => 'text'
        ));

        $this->addColumn(array(
            'name' => 'label',
            'header' => trans('Label'),
            'filter_type' => 'text'
        ));

        $this->addColumn(array(
            'name' => 'type',
            'header' => trans('Attribute Type'),
            'renderer' => new \Goxob\Catalog\Block\Admin\Grid\Renderer\AttributeType(),
            'filter_type' => 'dropdown',
            'filter_index' => 'type',
            'filter_data' => array(
                'collection' => \Goxob\Catalog\Helper\Attribute::getTypeList(),
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
            'name' => 'sort_order',
            'header' => trans('Sort Order'),
            'width' => "120px",
            'sort_order' => true,
        ));

    }

}