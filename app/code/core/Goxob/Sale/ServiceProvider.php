<?php namespace Goxob\Sale;

class ServiceProvider extends \Goxob\Core\ServiceProvider {

    public function register()
    {
        parent::register('sale');
    }

    public function boot()
    {
        parent::boot('sale');
    }

}