<?php
namespace Goxob\Catalog\Admin;

use Goxob\Core\Helper\Data;
use Goxob\Core\Html\Toolbar;

use View, Input, Session, Redirect, Route, Request, Form, Event, File, Validator, Str, Lang;

class CategoryController extends \Goxob\Core\Controller\AdminController {

    public function store()
    {
        $input = Input::all();

        //store item to db
        $category = \Goxob::getModel('catalog/category');
        $category->setData($input);
        if(!$category->save())
        {
            return Redirect::back()->withErrors($category->getErrors())->withInput();
        }

        //update path
        if(!$category->updatePath())
        {
            return Redirect::back()->withErrors($category->getErrors())->withInput();
        }

        //update child count
        $category->updateChildCount();

        return Redirect::to($this->objectUrl)->with('message', trans(ucfirst($this->viewKey).' Saved').'!');
    }


}