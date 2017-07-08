<?php namespace Goxob\Cms;

class ServiceProvider extends \Goxob\Core\ServiceProvider {

    public function register()
    {
        parent::register('cms');
    }

    public function boot()
    {
        parent::boot('cms');
    }

}