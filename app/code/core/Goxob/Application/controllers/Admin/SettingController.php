<?php
namespace Goxob\Application\Admin;

use Illuminate\Support\Facades\Redirect;
use View, Response, DB, Input;
use Goxob\Core\Html\Toolbar;

class SettingController extends \Goxob\Core\Controller\AdminBaseController {

    public function index()
    {
        Toolbar::title(trans('Settings'));
        Toolbar::submitButton('Save Settings', url('admin/setting/store'));

        //get all setting
        $rows = \Goxob::getModel('application/setting')->all();

        $setting = array();
        foreach($rows as $row)
        {
            $setting[$row->group][$row->key] = $row->value;
        }

        $data['item'] = $setting;
        return View::make('application.setting.index', $data);
    }

    public function store()
    {
        $input = Input::all();
        foreach($input as $key => $value)
        {
            //if not array, not setting data
            if(!is_array($value))continue;

            foreach($value as $stName => $stValue)
            {
                $data = array();
                $data['group'] = $key;
                $data['key'] = $stName;
                $data['value'] = $stValue;
                $model = \Goxob::getModel('application/setting');
                $model->setData($data);
                if(!$model->save())
                {
                    return Redirect::back()->withErrors($model->getErrors())->withInput();
                }
            }
        }

        return Redirect::to('admin/setting');

    }

}