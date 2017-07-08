<?php
namespace Goxob\Application;

use View;

class HomeController extends \Goxob\Core\Controller\BaseController {

	public function index()
	{
        return View::make('application.home.index');
	}

}