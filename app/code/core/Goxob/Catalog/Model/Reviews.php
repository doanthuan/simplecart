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


class Reviews extends \Goxob\Core\Model\ModelList{

    protected $defaultJoins = array('product');

    protected function joinProduct()
    {
        $this->query->addSelect('product.name as product_name');
        $this->query->join('product','product_review.product_id','=','product.product_id');
    }

}