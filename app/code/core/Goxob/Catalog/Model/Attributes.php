<?php
/**
 * Created by JetBrains PhpStorm.
 * User: thuan
 * Date: 4/23/14
 * Time: 4:00 PM
 * To change this template use File | Settings | File Templates.
 */

namespace Goxob\Catalog\Model;

use DB;


class Attributes extends \Goxob\Core\Model\ModelList{

    protected $defaultJoins = array('attribute_set');

    protected function joinAttributeSet()
    {
        $this->query->addSelect('attribute_set.name as attribute_set_name');
        $this->query->join('attribute_set','attribute_set.attr_set_id','=','attribute.attr_set_id');
    }

}