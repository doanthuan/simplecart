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


class AttributeSets extends \Goxob\Core\Model\ModelList{

    public function getAllAsArray()
    {
        $result = array();
        $items = $this->getAll();
        foreach($items as $item)
        {
            $result[$item->attr_set_id] = $item->name;
        }
        return $result;
    }

}