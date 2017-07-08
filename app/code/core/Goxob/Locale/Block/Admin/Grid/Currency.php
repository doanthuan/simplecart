<?php
namespace Goxob\Locale\Block\Admin\Grid;

use Goxob\Core\Block\Grid;

class Currency extends Grid{

    protected function prepareCollection()
    {
        $model = \Goxob::getModel('locale/currencies');
        $items = $this->getData($model);

        return $items;
    }

    protected function prepareColumns()
    {
        $this->addColumn(array(
            'name' => 'currency_id',
            'header' => trans('ID'),
            'key' => true,
            'filter_type' => 'range'
        ));

        $this->addColumn(array(
            'name' => 'title',
            'header' => trans('Title'),
            'filter_type' => 'text'
        ));

        $this->addColumn(array(
            'name' => 'code',
            'header' => trans('Code'),
            'filter_type' => 'text'
        ));

        $this->addColumn(array(
            'name' => 'symbol_left',
            'header' => trans('Symbol Left')
        ));

        $this->addColumn(array(
            'name' => 'symbol_right',
            'header' => trans('Symbol Right')
        ));

        $this->addColumn(array(
            'name' => 'value',
            'header' => trans('Value'),
            'filter_type' => 'text'
        ));

        $this->addColumn(array(
            'name' => 'status',
            'header' => trans('Status'),
            'published' => true,
        ));

        $this->addColumn(array(
            'name' => 'default',
            'header' => trans('Default'),
            'renderer' => new \Goxob\Locale\Block\Admin\Grid\Renderer\CurrencyDefault()
        ));
    }
}