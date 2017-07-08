<?php namespace Goxob\Catalog;

class ServiceProvider extends \Goxob\Core\ServiceProvider {

    public function register()
    {
        parent::register('catalog');
    }

    public function boot()
    {
        parent::boot('catalog');
    }

}