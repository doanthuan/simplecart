<?php
namespace Goxob\Cms\Block\Admin\Grid;

use Goxob\Core\Block\Grid;

class Content extends Grid{

    protected function prepareCollection()
    {
        $model = \Goxob::getModel('cms/contents')->join(array('category'));
        $items = $this->getData($model);

        return $items;
    }

    protected function prepareColumns()
    {
        $this->addColumn(array(
            'name' => 'content_id',
            'header' => trans('ID'),
            'key' => true,
            'filter_type' => 'range'
        ));

        $this->addColumn(array(
            'name' => 'title',
            'header' => trans('Title'),
            'filter_type' => 'text'
        ));

        $this->addColumn(array(
            'name' => 'alias',
            'header' => trans('Alias'),
            'filter_type' => 'text'
        ));

        $this->addColumn( array(
            'name' => 'category_name',
            'header' => trans('Category'),
            'filter_type' => 'dropdown',
            'filter_index' => 'category_id',
            'filter_data' => array(
                'collection' => \Goxob::getModel('cms/categories')->getAll(),
                'field_value' => 'category_id',
                'field_name' => 'name',
                'extraOptions' => array('' => trans('- Please Select -'))
            )
        ));

        $this->addColumn(array(
            'name' => 'status',
            'header' => trans('Status'),
            'published' => true,
        ));
    }
}