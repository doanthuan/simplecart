<?php namespace Goxob\Customer;

class ServiceProvider extends \Goxob\Core\ServiceProvider {

    public function register()
    {
        parent::register('customer');
    }

    public function boot()
    {
        parent::boot('customer');
    }

}