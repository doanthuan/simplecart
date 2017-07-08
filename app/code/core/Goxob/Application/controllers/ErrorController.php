<?php
namespace Goxob\Application;

use View, Redirect, Session;

class ErrorController extends \Goxob\Core\Controller\BaseController {

	public function index()
	{
        if(!Session::has('errors'))
        {
            return Redirect::to('/');
        }

        return View::make('error.alert');
	}

}