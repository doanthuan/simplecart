<?php
namespace Goxob\Core;
use Session, View;

abstract class ServiceProvider extends \Illuminate\Support\ServiceProvider {

    public function boot()
    {
        if ($module = $this->getModule(func_get_args()))
        {
            $this->package('goxob/' . $module, $module, app_path() . '/code/core/Goxob/' . $module);
        }
    }

    public function register()
    {
        if ($module = $this->getModule(func_get_args()))
        {
            $this->app['config']->package('goxob/' . $module, app_path() . '/code/core/Goxob/' . $module . '/config');

            // Add routes
            $routes = app_path() . '/code/core/Goxob/' . $module . '/routes.php';
            if (file_exists($routes)) require $routes;
            else{
                //echo $routes;exit;
                throw new Exception('Could not find route: '.$routes);
            }
        }
    }

    public function getModule($args)
    {
        $module = (isset($args[0]) and is_string($args[0])) ? $args[0] : null;
        $module = ucfirst($module);

        return $module;
    }

}