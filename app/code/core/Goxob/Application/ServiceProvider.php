<?php namespace Goxob\Application;

class ServiceProvider extends \Goxob\Core\ServiceProvider {

    public function register()
    {
        parent::register('application');
    }

    public function boot()
    {
        parent::boot('application');
    }

}