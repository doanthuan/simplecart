<?php

namespace Goxob\Sale\Helper;



class Order
{
    const STATUS_CANCEL = 0;
    const STATUS_COMPLETE = 1;
    const STATUS_ERROR = 2;
    const STATUS_PENDING = 3;
    const STATUS_PAYMENT_REVIEW = 4;
    const STATUS_PROCESSING = 5;
    const STATUS_ONHOLD = 6;

    public static function getStatusString($status)
    {
        switch($status)
        {
            case self::STATUS_CANCEL:
                return trans('Cancel');
            case self::STATUS_COMPLETE:
                return trans('Complete');
            case self::STATUS_PENDING:
                return trans('Pending');
            case self::STATUS_ERROR:
                return trans('Error');
            case self::STATUS_PAYMENT_REVIEW:
                return trans('Payment review');
            case self::STATUS_PROCESSING:
                return trans('Processing');
            case self::STATUS_ONHOLD:
                return trans('On Hold');
        }
    }



    public static function formatTime($time)
    {
        $time = strtotime($time);
        return date('d-m-Y H:i', $time);
    }

    public static function formatWithZeroPrefix($number, $numberZero=2)
    {
        return str_pad($number, $numberZero, '0', STR_PAD_LEFT);
    }

    public static function formatOrderId($orderId)
    {
        return sprintf("%09d",   $orderId);
    }

    public static function getOrderDetail($orderId)
    {
        $order = \Goxob::getModel('sale/order')->find($orderId);
        if(is_null($order))
        {
            \Goxob::error(trans('Could not find order by id!'));
        }

        $customer = $order->customer()->get();
        if(is_null($customer))//guest customer
        {
            $customer = \Goxob::getModel('customer/customer');
            $customer->email = $order->customer_email;
            $customer->phone = $order->customer_phone;
        }
        $products = $order->products()->with(array('images' => function($query){
            $query->where('default', 1);
        }))->get();


        $billingAddress = $order->addresses()->where('type', 0)->first();
        $shippingAddress = $order->addresses()->where('type', 1)->first();

        return array($order, $customer, $products, $billingAddress, $shippingAddress);
    }
}