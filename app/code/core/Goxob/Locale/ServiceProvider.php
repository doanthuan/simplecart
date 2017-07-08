<?php namespace Goxob\Locale;

class ServiceProvider extends \Goxob\Core\ServiceProvider {

    public function register()
    {
        parent::register('locale');
    }

    public function boot()
    {
        parent::boot('locale');
    }

}