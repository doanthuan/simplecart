<?php
/**
 * Created by JetBrains PhpStorm.
 * User: thuan
 * Date: 5/28/14
 * Time: 9:21 AM
 * To change this template use File | Settings | File Templates.
 */

namespace Goxob\Catalog\Block\Admin\Grid\Renderer;


class AttributeType implements \Goxob\Core\Block\Grid\RendererInterface{
    public function render($row)
    {
        return \Goxob\Catalog\Helper\Attribute::getTypeString($row->type);
    }
}