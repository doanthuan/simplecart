<?php
/**
 * Created by JetBrains PhpStorm.
 * User: thuan
 * Date: 5/19/14
 * Time: 10:57 AM
 * To change this template use File | Settings | File Templates.
 */

namespace Goxob\Catalog\EventListener;

use Input;


class ProductListener {

    public function onProductSaving()
    {
        //create new vendor
        $input = Input::all();
        if(!empty($input['vendor_name']))
        {
            $vendor = \Goxob::getModel('catalog/vendor')->firstOrCreate(array('vendor_name' => $input['vendor_name']));
            Input::merge(array('vendor_id' => $vendor->vendor_id));
        }
    }

    public function onProductSaved()
    {
        //update categories count
        \Goxob::getModel('catalog/category')->updateProductCount();
    }

    public function onProductDeleting()
    {
        //update categories count
        \Goxob::getModel('catalog/category')->updateProductCount();
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  Illuminate\Events\Dispatcher  $events
     * @return array
     */
    public function subscribe($events)
    {
        $events->listen('catalog.product.saving', '\Goxob\Catalog\EventListener\ProductListener@onProductSaving');

        $events->listen('catalog.product.saved', '\Goxob\Catalog\EventListener\ProductListener@onProductSaved');

        $events->listen('catalog.product.deleting', '\Goxob\Catalog\EventListener\ProductListener@onProductDeleting');
    }

}