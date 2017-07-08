<?php
/**
 * Created by JetBrains PhpStorm.
 * User: thuan
 * Date: 7/4/14
 * Time: 5:05 PM
 * To change this template use File | Settings | File Templates.
 */

namespace Goxob\Catalog\Block\Admin\Grid\Renderer;


class ProductPrice implements \Goxob\Core\Block\Grid\RendererInterface{
    public function render($row)
    {
        return \Goxob\Locale\Helper\Currency::formatPrice($row->price);
    }
}