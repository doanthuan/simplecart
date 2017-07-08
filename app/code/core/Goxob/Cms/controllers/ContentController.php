<?php
namespace Goxob\Cms;

use View, Input;

class ContentController extends \Goxob\Core\Controller\BaseController {

    public function category($alias)
    {
        Input::merge(array('page_category_alias' => $alias));
        return View::make('cms.content.category');
    }

	public function page($alias)
	{
        Input::merge(array('page_alias' => $alias));
        return View::make('cms.content.page');
	}

}