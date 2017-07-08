<?php
namespace Goxob\Customer\Block\Admin\Grid;

use Goxob\Core\Block\Grid;

class Address extends Grid{

    protected function prepareCollection()
    {
        $model = \Goxob::getModel('customer/addresses');
        $items = $this->getData($model);

        return $items;
    }

    protected function prepareColumns()
    {
        $this->addColumn(array(
            'name' => 'address_id',
            'header' => trans('ID'),
            'key' => true,
            'filter_type' => 'range',
            'class' => "col-md-1"
        ));

        $this->addColumn(array(
            'name' => 'first_name',
            'header' => trans('First Name'),
            'filter_type' => 'text'
        ));

        $this->addColumn(array(
            'name' => 'last_name',
            'header' => trans('Last Name'),
            'filter_type' => 'text'
        ));

        $this->addColumn(array(
            'name' => 'phone',
            'header' => trans('Phone'),
            'filter_type' => 'text'
        ));

        $this->addColumn(array(
            'name' => 'address',
            'header' => trans('Address'),
            'filter_type' => 'text'
        ));

        $this->addColumn(array(
            'name' => 'city',
            'header' => trans('City'),
            'filter_type' => 'text'
        ));

    }


}