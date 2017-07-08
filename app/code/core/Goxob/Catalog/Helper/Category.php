<?php

namespace Goxob\Catalog\Helper;


class Category {
    public static function getLink($category)
    {
        if(!is_object($category))
        {
            $category = \Goxob::getModel('catalog/category')->find($category);
            if(is_null($category)){
                throw new \Exception('Could not find category id');
            }
        }
        $slug = $category->category_id.'-'.$category->alias;
        return url('products').'/'.$slug;
    }

    public static function getCategoryId($slug)
    {
        if(strpos($slug, '-') === false){
            return;
        }
        list($categoryId) = explode('-', $slug);

        if(!is_numeric($categoryId)){
            return;
        }
        return $categoryId;
    }

    public static function filterByCategory(&$query, $categoryId)
    {
        $categoryIds = \Goxob::getModel('catalog/categories')->getChildrenIds($categoryId);
        $query->whereIn("category_id", $categoryIds);
    }
}