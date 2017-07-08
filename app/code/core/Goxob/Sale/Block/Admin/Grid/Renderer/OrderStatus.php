<?php
/**
 * Created by JetBrains PhpStorm.
 * User: thuan
 * Date: 6/18/14
 * Time: 3:26 PM
 * To change this template use File | Settings | File Templates.
 */

namespace Goxob\Sale\Block\Admin\Grid\Renderer;

class OrderStatus implements \Goxob\Core\Block\Grid\RendererInterface{
    public function render($row)
    {
        return \Goxob\Sale\Helper\Order::getStatusString($row->status);
    }
}