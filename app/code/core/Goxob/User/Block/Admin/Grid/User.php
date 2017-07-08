<?php
namespace Goxob\User\Block\Admin\Grid;

use Goxob\Core\Block\Grid;

class User extends Grid{

    protected function prepareCollection()
    {
        $model = \Goxob::getModel('user/users');
        $items = $this->getData($model);

        return $items;
    }

    protected function prepareColumns()
    {
        $this->addColumn(array(
            'name' => 'user_id',
            'header' => trans('ID'),
            'key' => true,
            'filter_type' => 'range',
            'class' => "col-md-1"
        ));

        $this->addColumn(array(
            'name' => 'username',
            'header' => trans('User Name'),
            'filter_type' => 'text'
        ));

        $this->addColumn(array(
            'name' => 'role_name',
            'header' => trans('Role'),
            'filter_type' => 'dropdown',
            'filter_index' => 'role_id',
            'filter_data' => array(
                'collection' => \Goxob::getModel('user/roles')->getAll(),
                'field_value' => 'role_id',
                'field_name' => 'role_name'
            )
        ));

        $this->addColumn(array(
            'name' => 'email',
            'header' => trans('Email'),
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
            'header' => trans('Date Added'),
            'filter_type' => 'range',
        ));


    }


}