<?php namespace Goxob\Slideshow;

class ServiceProvider extends \Goxob\Core\ServiceProvider {

    public function register()
    {
        parent::register('slideshow');
    }

    public function boot()
    {
        parent::boot('slideshow');
    }

}