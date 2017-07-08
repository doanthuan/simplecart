<?php
/**
 * Created by JetBrains PhpStorm.
 * User: thuan
 * Date: 5/28/14
 * Time: 9:21 AM
 * To change this template use File | Settings | File Templates.
 */

namespace Goxob\Catalog\Block\Admin\Grid\Renderer;


class CategoryName implements \Goxob\Core\Block\Grid\RendererInterface{
    public function render($row)
    {
        $style = '<span class="gi">|—</span>';
        $catName = '';
        for($i = 0; $i < $row->tree_level; $i++)
        {
            $catName .= $style;
        }
        return $catName. $row->name;
    }
}