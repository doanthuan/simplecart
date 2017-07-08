<?php
/**
 * Created by JetBrains PhpStorm.
 * User: thuan
 * Date: 6/10/14
 * Time: 10:40 AM
 * To change this template use File | Settings | File Templates.
 */

namespace Goxob\Application\Block;

use Input;

class BreadCrumb extends \Goxob\Core\Block\BaseBlock{

    protected $defaultTemplate = 'application.block.breadcrumb';

    public function prepareData()
    {
        $items = $this->getPathWay();
        $data['items'] = $items;
        return $data;
    }

    protected function getPathWay()
    {
        $categoryId = Input::get('cid');
        if(Input::has('pid'))
        {
            $productId = \Goxob\Catalog\Helper\Product::getProductId(Input::get('pid'));
            $product = \Goxob::getModel('catalog/product')->find($productId);
            $categoryId = $product->category_id;

            $productNav = new \stdClass();
            $productNav->name = $product->name;
        }

        if(!is_null($categoryId))
        {
            $categories = \Goxob::getModel('catalog/categories')->getParents($categoryId);
            if(isset($productNav))
            {
                $categories[] = $productNav;
            }
            return $categories;
        }
    }
}