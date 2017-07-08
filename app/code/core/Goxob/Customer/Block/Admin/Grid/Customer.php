<?php
namespace Goxob\Customer\Block\Admin\Grid;

use Goxob\Core\Block\Grid;

class Customer extends Grid{

    protected function prepareCollection()
    {
        $model = \Goxob::getModel('customer/customers');
        $items = $this->getData($model);

        return $items;
    }

    protected function prepareColumns()
    {
        $this->addColumn(array(
            'name' => 'customer_id',
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
            'name' => 'email',
            'header' => trans('Email'),
            'filter_type' => 'text'
        ));

        $this->addColumn(array(
            'name' => 'status',
            'header' => trans('Status'),
            'published' => true,
        ));

        $this->addColumn(array(
            'name' => 'created_at',
            'header' => trans('Date Added'),
            'filter_type' => 'range',
        ));


    }


}