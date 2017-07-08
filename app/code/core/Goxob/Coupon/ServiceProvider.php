<?php namespace Goxob\Coupon;

class ServiceProvider extends \Goxob\Core\ServiceProvider {

    public function register()
    {
        parent::register('coupon');
    }

    public function boot()
    {
        parent::boot('coupon');
    }

}