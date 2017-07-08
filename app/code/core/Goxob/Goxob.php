<?php


final class Goxob
{
    public static function isAdmin()
    {
        if (Request::is('admin*'))
        {
            return true;
        }
        return false;
    }

    public static function initView()
    {
        /*
        |--------------------------------------------------------------------------
        | Add view paths
        |--------------------------------------------------------------------------
        */
        $template = Config::get('view.template');
        $adminTemplate = Config::get('view.admin_template');
        if( !empty($template) && !self::isAdmin())
        {
            $viewPath = app('path')."/template/{$template}";
        }
        else if(!empty($adminTemplate) && self::isAdmin())
        {
            $viewPath = app('path')."/template/admin/{$adminTemplate}";
        }
        if(isset($viewPath)){
            View::addLocation($viewPath);
        }

        //add base path
        $basePath = app('path')."/template/base";
        if(self::isAdmin())
        {
            $basePath = app('path')."/template/admin/base";
        }
        View::addLocation($basePath);
    }

    public static function setSegments($route)
    {
        if(!self::isAdmin()){
            return;
        }

        //store current module, controller, action base for admin side
        $action = $route->getAction();
        if(isset($action['controller']))
        {
            $controllerAction = $action['controller'];
            if(strpos($controllerAction,'@') !== false)
            {
                $segments = explode('@', $controllerAction);
                $actionName = $segments[1];
                Session::put('current_action', $actionName);
                if(strpos($segments[0],'\\') !== false )
                {
                    $segments1 = explode("\\", $segments[0]);
                    $controllerName = end($segments1);
                    if(strpos($controllerName, 'Controller') === false)
                    {
                        throw new \InvalidArgumentException("Controller name:{$controllerName} is invalid.");
                    }
                    $controller = self::getControllerName($controllerName);
                    Session::put('prev_controller', Session::get('current_controller'));
                    Session::put('current_controller', $controller);

                    if(count($segments1) > 2)
                    {
                        $moduleName = strtolower($segments1[2]);
                        Session::put('current_module', $moduleName);
                    }
                }
            }
        }
    }

    public static function routeAdminController($module, $controller)
    {
        Route::group(array('prefix' => 'admin/'.$module.'/'.$controller), function() use ($module, $controller)
        {
            $module = \Goxob\Core\Helper\Data::dashes2camel($module);
            $controllerClass = \Goxob\Core\Helper\Data::dashes2camel($controller);

            Route::match(array('GET', 'POST'),'/', '\Goxob\\'.$module.'\Admin\\'.$controllerClass.'Controller@index');

            Route::match(array('GET', 'POST'),'/index', '\Goxob\\'.$module.'\Admin\\'.$controllerClass.'Controller@index');

            Route::get('create', '\Goxob\\'.$module.'\Admin\\'.$controllerClass.'Controller@create');

            Route::get('edit', '\Goxob\\'.$module.'\Admin\\'.$controllerClass.'Controller@edit');

            Route::post('store', '\Goxob\\'.$module.'\Admin\\'.$controllerClass.'Controller@store');

            Route::post('delete', '\Goxob\\'.$module.'\Admin\\'.$controllerClass.'Controller@delete');
        });
    }

    public static function getBaseUrl($type = 'skin')
    {
        $template = Config::get('view.template', 'base');
        $url = url('');
        switch($type)
        {
            case 'media':
                return $url.'/media';
            case 'skin':
            {
                $path = '/skin/'.$template;
                if(self::isAdmin())
                {
                    $path = '/skin/admin/'.$template;
                }
                return $url.$path;
            }
        }
        return $url;
    }

    public static function getClassName($name)
    {
        if(strpos($name,'-') !== false)
        {
            $classSegments = explode('-', $name);
            $className = '';
            foreach($classSegments as $segment)
            {
                $className .= ucfirst($segment);
            }
            return $className;
        }
        else{
            return ucfirst($name);
        }
    }

    public static function getControllerName($controllerName)
    {
        if(strpos($controllerName,'\\') !== false)
        {
            $controllerName = end(explode('\\', $controllerName));
        }
        $ctrlSegments = explode('Controller', $controllerName);
        $controller = $ctrlSegments[0];
        return $controller;
    }

    public static function getBlock($name, array $params = null)
    {
        $nameSegments = explode('/', $name);
        if(count($nameSegments) != 2)
        {
            throw new \InvalidArgumentException("Block Name: {$name} couldn't be loaded.");
        }

        $module = ucfirst($nameSegments[0]);
        $class = self::getClassName($nameSegments[1]);

        if(strpos($class,'.') !== false)
        {
            $classSegments = explode('.', $class);
            $classSegments = array_map('ucfirst', $classSegments);
            $class = implode("\\", $classSegments);
        }

        $className = "\\Goxob\\{$module}\\Block\\{$class}";
        if(self::isAdmin() && $module != 'Core' && !self::isFrontendBlock($params) )
        {
            $className = "\\Goxob\\{$module}\\Block\\Admin\\{$class}";
        }

        $instance = new $className();
        if(!is_null($params))
        {
            $instance->setParams($params);
        }

        if(self::isFrontendBlock($params))
        {
            $template = Config::get('view.template');
            if( !empty($template) )
            {
                $viewPath = app('path')."/template/{$template}";
                View::addLocation($viewPath);
            }
            View::addLocation(app('path')."/template/base");
        }

        return $instance;
    }

    private static function isFrontendBlock($params)
    {
        return (isset($params['frontend']) || isset($params['parent']->params['frontend']));
    }

    public static function getModel($name, $pk = null)
    {
        $nameSegments = explode('/', $name);
        if(count($nameSegments) != 2)
        {
            throw new \InvalidArgumentException("Model Name: {$name} couldn't be loaded.");
        }

        $module = ucfirst($nameSegments[0]);
        $class = self::getClassName($nameSegments[1]);
        $className = "\\Goxob\\{$module}\\Model\\{$class}";

        if(isset($pk) && !empty($pk)){
            $model = $className::find($pk);
        }else{
            $model = new $className();
        }
        return $model;
    }

    public static function error($message, $code = 0)
    {
        Session::flush();
        throw new \Exception($message, $code);
    }

    public static function warning($errors)
    {
        Session::flush();
        return Illuminate\Support\Facades\Redirect::to('error')->withErrors($errors)->send();
    }

    public static function back($errors = null)
    {
        return Illuminate\Support\Facades\Redirect::back()->withErrors($errors)->withInput()->send();
    }

    public static function getSetting($key, $default = null)
    {
        return \Goxob\Application\Helper\Setting::get($key, $default);
    }
}