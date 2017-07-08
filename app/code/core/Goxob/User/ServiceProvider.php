<?php namespace Goxob\User;

class ServiceProvider extends \Goxob\Core\ServiceProvider {

    public function register()
    {
        parent::register('user');
    }

    public function boot()
    {
        parent::boot('user');
    }

}