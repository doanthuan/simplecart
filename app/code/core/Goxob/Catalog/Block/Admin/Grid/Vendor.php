<?php
namespace Goxob\Catalog\Block\Admin\Grid;

use Goxob\Core\Block\Grid;

class Vendor extends Grid{

    protected function prepareCollection()
    {
        $model = \Goxob::getModel('catalog/vendors');
        $items = $this->getData($model);

        return $items;
    }

    protected function prepareColumns()
    {
        $this->addColumn(array(
            'name' => 'vendor_id',
            'header' => trans('ID'),
            'key' => true,
            'filter_type' => 'range',
            'class' => "col-md-1"
        ));

        $this->addColumn(array(
            'name' => 'vendor_name',
            'header' => trans('Vendor Name'),
            'filter_type' => 'text'
        ));

        $this->addColumn(array(
            'name' => 'country',
            'header' => trans('Country'),
            'filter_type' => 'text'
        ));

        $this->addColumn(array(
            'name' => 'email',
            'header' => trans('Email'),
            'filter_type' => 'text'
        ));

    }

}