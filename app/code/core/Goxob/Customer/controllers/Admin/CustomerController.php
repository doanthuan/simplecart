<?php
namespace Goxob\Customer\Admin;

use View, Input, Session, Redirect, Route, Request, Form, Event, File, Validator, Str, Lang, Response;

class CustomerController extends \Goxob\Core\Controller\AdminController {

    public function ajaxSearch()
    {
        if(Input::has('term'))
        {
            $term = Input::get('term');
            $query = \Goxob::getModel('customer/customers')->getSelect()
                ->where('first_name','like','%'.$term.'%')
                ->orWhere('last_name','like','%'.$term.'%');
            $result = $query->get();
            return Response::json($result);
        }
    }

}