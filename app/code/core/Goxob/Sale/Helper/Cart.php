<?php
/**
 * Created by JetBrains PhpStorm.
 * User: thuan
 * Date: 6/11/14
 * Time: 11:14 AM
 * To change this template use File | Settings | File Templates.
 */

namespace Goxob\Sale\Helper;

use Session;

class Cart {
    protected static $cartItems;

    protected static $cartProducts;
    protected static $cartTotalAmount;

    public static function setCartItems($cartItems)
    {
        static::$cartItems = $cartItems;
    }

    public static function getCartItems()
    {
        $cartItems = static::$cartItems;
        if(is_null($cartItems))
        {
            $cartItems = Session::get('cart_products');
        }
        return $cartItems;
    }

    public static function getCartProducts()
    {
        if(!is_null(static::$cartProducts)){
            return static::$cartProducts;
        }

        $cartItems = static::getCartItems();
        if(!is_array( $cartItems ) || empty($cartItems)){
            static::$cartProducts = null;
            return null;
        }

        $productIds = array_keys( $cartItems );
        $products = \Goxob::getModel('catalog/products')->getSelect()->whereIn('product.product_id', $productIds)->get();
        foreach($products as $product)
        {
            $product->cart_qty = $cartItems[$product->product_id];
        }
        static::$cartProducts = $products;
        return $products;
    }

    public static function getTotalAmount()
    {
        $total = 0;
        if(!is_null(static::$cartTotalAmount))
        {
            return static::$cartTotalAmount;
        }

        $products = static::getCartProducts();
        if(count($products) > 0){
            foreach($products as $product)
            {
                $total += ($product->price * $product->cart_qty);
            }
            static::$cartTotalAmount = $total;
        }
        return $total;
    }

    public static function hasCartItems()
    {
        $cartItems = static::getCartItems();
        if(!is_array( $cartItems ) || empty($cartItems)){
            return false;
        }
        return true;
    }

    public static function flush()
    {
        Session::forget('cart_products');
    }

    public static function hasShipping()
    {
        $cartProducts = static::getCartProducts();
        foreach($cartProducts as $product)
        {
            if($product->weight > 0){
                return true;
            }
        }
        return false;
    }
}