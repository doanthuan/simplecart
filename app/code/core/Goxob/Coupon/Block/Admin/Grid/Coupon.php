<?php
namespace Goxob\Coupon\Block\Admin\Grid;

use Goxob\Core\Block\Grid;

class Coupon extends Grid{

    protected function prepareCollection()
    {
        $model = \Goxob::getModel('coupon/coupons');
        $items = $this->getData($model);

        return $items;
    }

    protected function prepareColumns()
    {
        $this->addColumn(array(
            'name' => 'coupon_id',
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
            'name' => 'code',
            'header' => trans('Code'),
            'filter_type' => 'text'
        ));

        $this->addColumn(array(
            'name' => 'discount',
            'header' => trans('Discount'),
            'filter_type' => 'text'
        ));

        $this->addColumn(array(
            'name' => 'date_start',
            'header' => trans('Date Start'),
            'filter_type' => 'text'
        ));

        $this->addColumn(array(
            'name' => 'date_end',
            'header' => trans('Date End'),
            'filter_type' => 'text'
        ));

        $this->addColumn(array(
            'name' => 'status',
            'header' => trans('Status'),
            'published' => true,
        ));
    }
}