<?php
namespace Goxob\Catalog\Block\Admin\Grid;

use Goxob\Core\Block\Grid;

class Review extends Grid{

    protected function prepareCollection()
    {
        $model = \Goxob::getModel('catalog/reviews');
        $items = $this->getData($model);

        return $items;
    }

    protected function prepareColumns()
    {
        $this->addColumn(array(
            'name' => 'review_id',
            'header' => trans('ID'),
            'key' => true,
            'filter_type' => 'range',
            'class' => "col-md-1"
        ));

        $this->addColumn(array(
            'name' => 'product_name',
            'header' => trans('Product'),
            'filter_type' => 'text'
        ));

        $this->addColumn(array(
            'name' => 'author',
            'header' => trans('Author'),
            'filter_type' => 'text'
        ));

        $this->addColumn(array(
            'name' => 'rating',
            'header' => trans('Rating'),
            'filter_type' => 'text'
        ));

        $this->addColumn(array(
            'name' => 'status',
            'header' => trans('Status'),
            'filter_type' => 'dropdown',
            'filter_index' => 'status',
            'filter_data' => array(
                'collection' => array('1' => 'Enable', '0' => 'Disable')
            ),
            'published' => true,
        ));

        $this->addColumn(array(
            'name' => 'created_at',
            'header' => trans('Created Date'),
            'filter_type' => 'range',
        ));

    }

}