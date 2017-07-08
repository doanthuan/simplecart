<?php
namespace Goxob\Cms\Model;

use Session;

class Contents extends \Goxob\Core\Model\ModelList{

    protected $defaultJoins = array('category');

    protected function joinCategory()
    {
        $this->query->addSelect('cms_category.name as category_name');
        $this->query->leftJoin('cms_category', 'cms_content.category_id', '=', 'cms_category.category_id' );
    }

}