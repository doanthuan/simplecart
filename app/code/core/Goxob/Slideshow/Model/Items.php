<?php
namespace Goxob\Slideshow\Model;

use Session;

class Items extends \Goxob\Core\Model\ModelList{

    protected $defaultJoins = array('group');

    protected function joinGroup()
    {
        $this->query->addSelect('slideshow_group.name as group_name');
        $this->query->leftJoin('slideshow_group', 'slideshow_item.group_id', '=', 'slideshow_group.group_id' );
    }

}