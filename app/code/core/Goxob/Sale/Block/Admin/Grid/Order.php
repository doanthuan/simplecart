<?php
namespace Goxob\Sale\Block\Admin\Grid;

class Order extends \Goxob\Core\Block\Grid{

    protected function prepareCollection()
    {
        $model = \Goxob::getModel('sale/orders');
        $items = $this->getData($model);
        return $items;
    }

    protected function prepareColumns()
    {
        $this->addColumn(array(
            'name' => 'order_id',
            'header' => trans('ID'),
            'key' => true,
            'filter_type' => 'range',
            'class' => "col-md-1"
        ));

        $this->addColumn(array(
            'name' => 'amount',
            'header' => trans('Amount'),
            'filter_type' => 'text'
        ));

        $this->addColumn(array(
            'name' => 'customer_email',
            'header' => trans('Customer'),
            'filter_type' => 'text'
        ));

        $this->addColumn(array(
            'name' => 'status',
            'header' => trans('Status'),
            'filter_type' => 'text',
            'renderer' => new \Goxob\Sale\Block\Admin\Grid\Renderer\OrderStatus()
        ));

        $this->addColumn(array(
            'name' => 'created_at',
            'header' => trans('Created At'),
            'filter_type' => 'range',
        ));

        $this->addColumn(array(
            'name' => 'update_at',
            'header' => trans('Updated At'),
            'filter_type' => 'range',
        ));

    }

    public function getActionLinks($item)
    {
        $links = '';
        $links .= '<a href="/admin/sale/order/detail/'.$item->getKey().'">'.trans('View').'</a>';
        return $links;
    }

}