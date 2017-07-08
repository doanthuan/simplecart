<?php
namespace Goxob\Catalog\Model;

use Session;

class Products extends \Goxob\Core\Model\ModelList{

    protected $defaultJoins = array('image');

    protected function joinImage()
    {
        $this->query->addSelect('product_image.img_name');
        $this->query->leftJoin('product_image', function($join)
        {
            $join->on('product.product_id', '=', 'product_image.product_id')->where('product_image.default', '=', '1');
        });
    }

    protected function joinAttributeSet()
    {
        $this->query->addSelect('attribute_set.name as attribute_set_name');
        $this->query->leftJoin('attribute_set', 'product.attr_set_id', '=', 'attribute_set.attr_set_id' );
    }

    protected function joinCategory()
    {
        $this->query->addSelect('category.name as category_name');
        $this->query->leftJoin('category', 'product.category_id', '=', 'category.category_id' );
    }

}