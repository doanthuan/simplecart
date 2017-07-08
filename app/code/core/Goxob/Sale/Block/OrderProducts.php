<?php
/**
 * Created by JetBrains PhpStorm.
 * User: thuan
 * Date: 6/14/14
 * Time: 2:13 PM
 * To change this template use File | Settings | File Templates.
 */

namespace Goxob\Sale\Block;


class OrderProducts extends \Goxob\Core\Block\BaseBlock{

    protected $defaultTemplate = 'sale.block.order-products';

    public function prepareData()
    {
        $data['products'] = $this->params['products'];
        $data['totalAmount'] = $this->params['totalAmount'];
        return array($data);
    }

}