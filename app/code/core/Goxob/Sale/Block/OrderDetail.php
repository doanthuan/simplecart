<?php
/**
 * Created by JetBrains PhpStorm.
 * User: thuan
 * Date: 6/14/14
 * Time: 2:13 PM
 * To change this template use File | Settings | File Templates.
 */

namespace Goxob\Sale\Block;


class OrderDetail extends \Goxob\Core\Block\BaseBlock{

    protected $defaultTemplate = 'sale.block.order-detail';

    public function prepareData()
    {
        if(!isset($this->params['order_id'])){
            \Goxob::error(trans('Order ID is required'));
        }
        $orderId = $this->params['order_id'];
        list($order, $customer, $products, $billingAddress, $shippingAddress) = \Goxob\Sale\Helper\Order::getOrderDetail($orderId);

        $data['order'] = $order;
        $data['customer'] = $customer;
        $data['products'] = $products;
        $data['billingAddress'] = $billingAddress;
        $data['shippingAddress'] = $shippingAddress;
        return $data;
    }

}