<?php
namespace Goxob\Catalog\Block\Admin\Grid;

use Goxob\Core\Block\Grid;

class Category extends Grid{

    protected function prepareCollection()
    {
        $items = \Goxob::getModel('catalog/categories')->getChildren();
        return $items;
    }

    protected function prepareColumns()
    {
        $this->addColumn(array(
            'name' => 'category_id',
            'header' => trans('ID'),
            'key' => true,
            'filter_type' => 'range',
            'class' => "col-md-1"
        ));

        $this->addColumn(array(
            'name' => 'name',
            'header' => trans('Name'),
            'filter_type' => 'text',
            'renderer' => new \Goxob\Catalog\Block\Admin\Grid\Renderer\CategoryName(),
        ));

        $this->addColumn(array(
            'name' => 'child_count',
            'header' => trans('Child Count'),
            'class' => "col-md-2"
        ));

//        $this->addColumn(array(
//            'name' => 'sort_order',
//            'header' => trans('Sort Order'),
//            'width' => "120px",
//            'sort_order' => true,
//        ));
    }

}