<?php
namespace Goxob\Catalog\Admin;

use Goxob\Core\Helper\Data;

use View, Input, Session, Redirect, Route, Request, Form, Event, File, Validator, Str, Lang;

class AttributeController extends \Goxob\Core\Controller\AdminController {

    public function store()
    {
        $input = Input::all();

        //store item to db
        $attribute = $this->model;
        $attribute->setData($input);
        if(!$attribute->save())
        {
            return Redirect::back()->withErrors($attribute->getErrors())->withInput();
        }

        if(empty($input['attr_id'])){
            //update association
            $products = \Goxob::getModel('catalog/products')->getSelect()->where('attr_set_id', $attribute->attr_set_id)->get();
            foreach($products as $product){
                $product->attributes()->attach($attribute->attr_id, array('attr_value' => ''));
            }
        }

        return Redirect::to($this->objectUrl)->with('message', trans(ucfirst($this->viewKey).' Saved').'!');
    }

    public function delete()
    {
        $cid = Input::get('cid');
        if (empty($cid)){
            return Redirect::back()->withErrors(trans('No attribute selected'));
        }

        //$this->model->destroy($cid);
        $attributes = $this->model->find($cid);
        foreach($attributes as $attribute)
        {
            if (!$attribute->delete())
            {
                return Redirect::back()->withErrors(trans('Error delete attribute'));
            }

            //update association
            $attribute->products()->detach();
        }

        return Redirect::to($this->objectUrl)->with('message', trans('Attribute deleted').'!');
    }

}