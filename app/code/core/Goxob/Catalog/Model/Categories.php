<?php

namespace Goxob\Catalog\Model;

use DB;


class Categories extends \Goxob\Core\Model\ModelList{

    public function getChildren($categoryId = 0, $recursion = true, $order = "", $orderDir = 'ASC')
    {
        $result = array();

        $query = $this->getSelect();
        $query->where('parent_id','=', $categoryId);

        if(!empty($order)){
            $query->orderBy($order, $orderDir);
        }
        else{
            $query->orderBy('sort_order', $orderDir);
        }
        $rows = $query->get();

        if(count($rows) > 0 && $recursion){
            foreach($rows as $row)
            {
                $result[] = $row;

                $children = $this->getChildren($row->category_id, $recursion);
                if(count($children) > 0)
                {
                    $result = array_merge($result, $children);
                }
            }
        }
        else{
            $result = $rows;
        }
        return $result;
    }

    public function getChildrenIds($categoryId, $recursion = true)
    {
        $categories = $this->getChildren($categoryId, $recursion);

        $curCategory = \Goxob::getModel('catalog/category')->find($categoryId);

        $categories[] = $curCategory;

        if(count($categories) > 0)
        {
            $categoryIds = array();
            foreach($categories as $cat)
            {
                $categoryIds[] = $cat->category_id;
            }
        }
        return $categoryIds;
    }

    public function getParentNames($categoryId)
    {
        $result = array();
        $parentCategories = $this->getParents($categoryId);
        foreach($parentCategories as $category){
            $result[] = $category->name;
        }
        return $result;
    }

    public function getParentIds($categoryId)
    {
        $result = array();
        $parentCategories = $this->getParents($categoryId);
        foreach($parentCategories as $category){
            $result[] = $category->category_id;
        }
        return $result;
    }

    public function getParents($categoryId)
    {
        $category = \Goxob::getModel('catalog/category')->find($categoryId);
        if(is_null($category)){
            return \Goxob::error(trans('Could not find category'));
        }
        $path = $category->path;
        $categoryIds = explode('/', $path);
        $categories = $this->getSelect()->whereIn('category_id', $categoryIds)->get();
        return $categories;
    }

}