<?php
namespace Goxob\Catalog;

use View, Input, Redirect, Response, Session, Validator, Request;

class CategoryController extends \Goxob\Core\Controller\BaseController {

    public function ajaxSearch($search)
    {
        if(!empty($search))
        {
            $query = \Goxob::getModel('catalog/categories')->getSelect()->where('name','like','%'.$search.'%');
            $result = $query->get();
            return Response::json($result);
        }
    }

}