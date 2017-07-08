<?php
namespace Goxob\Core\Controller;
use Controller, View, Config, Session, Route, Input, Redirect, Str, Lang;
use \Goxob\Core\Html\Toolbar;
use \Goxob\Core\Helper\Data;

class AdminController extends AdminBaseController {

    protected $module;

    protected $name;

    protected $viewKey;

    protected $model;

    protected $objectUrl;

    protected $createUrl;

    protected $editUrl;

    protected $storeUrl;

    protected $deleteUrl;

    public function __construct()
    {
        parent::__construct();

        //set module
        $module = Session::get('current_module');
        $this->module = $module;

        //set name
        $controller = Session::get('current_controller');
        $this->name = $controller;

        //set view key
        if(!isset($this->viewKey))
        {
            $this->viewKey = Data::camel2dashed($controller);
        }

        //set model
        $this->model = $this->getModel();

        $this->setHandyUrls();
        $this->shareHandyUrls();

        $this->resetGridFilters();
    }


    /**
     * Set the URL's to be used in the views
     * @return void
     */
    private function setHandyUrls()
    {
        $this->objectUrl = url('admin/'.$this->module.'/'.$this->viewKey);

        if( is_null( $this->createUrl ) )
            $this->createUrl = $this->objectUrl.'/create';

        if( is_null( $this->editUrl ) )
            $this->editUrl = $this->objectUrl.'/edit';

        if( is_null( $this->storeUrl ) )
            $this->storeUrl = $this->objectUrl.'/store';

        if( is_null( $this->deleteUrl ) )
            $this->deleteUrl = $this->objectUrl.'/delete';
    }

    /**
     * Set the view to have variables detailing some of the key URL's used in the views
     * Trying to keep views generic...
     * @return void
     */
    private function shareHandyUrls()
    {
        // Share these variables with any views
        View::share('objectUrl', $this->objectUrl);
        View::share('createUrl', $this->createUrl);
        View::share('editUrl', $this->editUrl);
        View::share('storeUrl', $this->storeUrl);
        View::share('deleteUrl', $this->deleteUrl);

        Session::put('editUrl', $this->editUrl);
    }

    private function resetGridFilters()
    {
        //reset grid filters when switch controllers
        $currentController = Session::get('current_controller');
        $prevController = Session::get('prev_controller');
        if(isset($prevController) && $prevController != $currentController)
        {
            Session::forget('grid_filters');
        }
    }

    public function getModel()
    {
        $controller = ucfirst(Session::get('current_controller'));
        $module = ucfirst(Session::get('current_module'));

        $className = "\\Goxob\\{$module}\\Model\\{$controller}";
        return new $className();
    }

    public function index()
    {
        $title = trans('Manage '.Str::plural($this->name));
        Toolbar::title($title);
        Toolbar::buttons(array(Toolbar::BUTTON_CREATE, Toolbar::BUTTON_DELETE)) ;

        return View::make($this->module.'.'.$this->viewKey.'.index');
    }

    public function create()
    {
        $title = trans('New '.ucfirst($this->name));
        Toolbar::title($title);
        Toolbar::buttons(array(Toolbar::BUTTON_SAVE, Toolbar::BUTTON_CANCEL)) ;

        $item = $this->model;
        $data['item'] = $item;

        return View::make($this->module.'.'.$this->viewKey.'.edit', $data);
    }

    public function edit()
    {
        $title = trans('Edit '.ucfirst($this->name));
        Toolbar::title($title);
        Toolbar::buttons(array(Toolbar::BUTTON_SAVE, Toolbar::BUTTON_CANCEL)) ;

        $item = $this->model->find(Input::get('id'));
        if(is_null($item))
        {
            throw new \Exception('Could not find record');
        }
        $data['item'] = $item;

        return View::make($this->module.'.'.$this->viewKey.'.edit', $data);
    }

    public function store()
    {
        $input = Input::all();

        //store item to db
        $item = $this->model;
        $item->setData($input);
        if(!$item->save())
        {
            return Redirect::back()->withErrors($item->getErrors())->withInput();
        }

        return Redirect::to($this->objectUrl)->with('message', trans(ucfirst($this->viewKey).' Saved').'!');
    }

    public function setFilter()
    {
        $input = Input::all();
        Session::put('grid_filters', $input);

        return Redirect::to($this->objectUrl);
    }

    public function resetFilter()
    {
        Session::forget('grid_filters');
        return Redirect::to($this->objectUrl);
    }

    public function delete()
    {
        $cid = Input::get('cid');
        if (empty($cid)){
            return Redirect::back()->withErrors(trans('No '.$this->viewKey.' selected'));
        }

//        $items = $this->model->find($cid);
//        foreach($items as $item)
//        {
//            if (!$item->delete())
//            {
//                return Redirect::back()->withErrors(trans('Error delete '.Str::plural($this->viewKey)));
//            }
//        }
        $this->model->destroy($cid);

        return Redirect::to($this->objectUrl)->with('message', trans(ucfirst(Str::plural($this->viewKey)).'(s) deleted').'!');
    }

    public function publish()
    {
        // Get items to publish from the request.
        $cid = Input::get('cid');
        $value = Input::get('params');
        if (empty($cid))
        {
            return Redirect::back()->withErrors(trans('No '.$this->viewKey.' selected'));
        }

        // Publish the items.
        if (!$this->model->publish($cid, $value))
        {
            return Redirect::back()->withErrors(trans('Error publish '.Str::plural($this->viewKey)));
        }

        return Redirect::to($this->objectUrl);
    }

    public function saveSortOrder()
    {
        // Get the input
        $pks = Input::get('cid');
        $order = Input::get('order');

        if(empty($pks))
        {
            return Redirect::back()->withErrors(trans('No '.$this->viewKey.' selected'));
        }

        // Sanitize the input
        Data::toInteger($pks);
        Data::toInteger($order);

        // Save the sort_order
        $return = $this->model->saveorder($pks, $order);
        if ($return === false)
        {
            return Redirect::to($this->objectUrl)->with('message', trans('Reorder Failed'));
        }
        else
        {
            return Redirect::to($this->objectUrl)->with('message', trans('Reorder Success'));
        }
    }

}