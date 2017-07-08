<?php
namespace Goxob\Slideshow\Block\Admin\Grid;

use Goxob\Core\Block\Grid;

class Group extends Grid{

    protected function prepareCollection()
    {
        $model = \Goxob::getModel('slideshow/groups');
        $items = $this->getData($model);

        return $items;
    }

    protected function prepareColumns()
    {
        $this->addColumn(array(
            'name' => 'group_id',
            'header' => trans('ID'),
            'key' => true,
            'filter_type' => 'range',
            'class' => "col-md-1"
        ));

        $this->addColumn(array(
            'name' => 'name',
            'header' => trans('Name'),
            'filter_type' => 'text'
        ));

        $this->addColumn(array(
            'name' => 'alias',
            'header' => trans('Alias'),
            'filter_type' => 'text'
        ));
    }

}