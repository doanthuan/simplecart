<?php
namespace Goxob\User\Block\Admin\Grid;

use Goxob\Core\Block\Grid;

class Role extends Grid{

    protected function prepareCollection()
    {
        $model = \Goxob::getModel('user/roles');
        $items = $this->getData($model);

        return $items;
    }

    protected function prepareColumns()
    {
        $this->addColumn(array(
            'name' => 'role_id',
            'header' => trans('ID'),
            'key' => true,
            'filter_type' => 'range',
            'class' => "col-md-1"
        ));

        $this->addColumn(array(
            'name' => 'role_name',
            'header' => trans('Role Name'),
            'filter_type' => 'text'
        ));

    }


}