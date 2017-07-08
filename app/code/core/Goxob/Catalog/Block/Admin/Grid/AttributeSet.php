<?php
namespace Goxob\Catalog\Block\Admin\Grid;

use Goxob\Core\Block\Grid;

class AttributeSet extends Grid{

    protected function prepareCollection()
    {
        $model = \Goxob::getModel('catalog/attribute-sets');
        $items = $this->getData($model);

        return $items;
    }

    protected function prepareColumns()
    {
        $this->addColumn(array(
            'name' => 'attr_set_id',
            'header' => trans('ID'),
            'key' => true,
            'filter_type' => 'range',
            'class' => "col-md-1"
        ));

        $this->addColumn(array(
            'name' => 'name',
            'header' => trans('Name'),
            'filter_type' => 'text'
        ));


    }

}