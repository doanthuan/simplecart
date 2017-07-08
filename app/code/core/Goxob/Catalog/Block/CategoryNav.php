<?php
namespace Goxob\Catalog\Block;

use View;

class CategoryNav extends \Goxob\Core\Block\BaseBlock{

    protected $defaultTemplate = 'catalog.block.category-nav-sidebar';

    public function prepareData()
    {
        $data['categories'] = \Goxob::getModel('catalog/categories')->getChildren();
        $data['title'] = trans('Categories');

        return $data;
    }
}