<?php
namespace Goxob\Slideshow\Block\Admin\Grid;

use Goxob\Core\Block\Grid;

class Item extends Grid{

    protected function prepareCollection()
    {
        $model = \Goxob::getModel('slideshow/items')->join(array('group'));
        $items = $this->getData($model);

        return $items;
    }

    protected function prepareColumns()
    {
        $this->addColumn(array(
            'name' => 'item_id',
            'header' => trans('ID'),
            'key' => true,
            'filter_type' => 'range'
        ));

        $this->addColumn(array(
            'name' => 'name',
            'header' => trans('Name'),
            'filter_type' => 'text'
        ));

        $this->addColumn(array(
            'name' => 'link_to',
            'header' => trans('Link to'),
            'filter_type' => 'text'
        ));

        $this->addColumn( array(
            'name' => 'group_name',
            'header' => trans('Group'),
            'filter_type' => 'dropdown',
            'filter_index' => 'group_id',
            'filter_data' => array(
                'collection' => \Goxob::getModel('slideshow/groups')->getAll(),
                'field_value' => 'group_id',
                'field_name' => 'name',
                'extraOptions' => array('' => trans('- Please Select -'))
            )
        ));
    }
}