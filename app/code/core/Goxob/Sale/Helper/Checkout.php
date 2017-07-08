<?php
namespace Goxob\Sale\Helper;

use Session, Input, Auth, Redirect;

class Checkout {

    const PAY_METHOD_CASH = 1;
    const PAY_METHOD_PAYPAL = 2;
    const PAY_METHOD_CREDIT = 3;
    const PAY_METHOD_TRANSFER = 4;

    const SHIPPING_METHOD_FREE = 0;
    const SHIPPING_METHOD_FLAT = 1;

    protected $customer;
    protected $billingAddress;
    protected $shippingAddress;
    protected $shippingMethod;
    protected $paymentInfo;

    protected $order;

    /**
     * @param mixed $customer
     */
    public static function setCustomer($customer)
    {
        Session::put('checkout_customer', $customer);
    }

    /**
     * @return mixed
     */
    public static function getCustomer()
    {
        return Session::get('checkout_customer');
    }

    /**
     * @param mixed $billingAddress
     */
    public static function setBillingAddress($billingAddress)
    {
        Session::put('checkout_billing', $billingAddress);
    }

    /**
     * @return mixed
     */
    public static function getBillingAddress()
    {
        return Session::get('checkout_billing');
    }

    /**
     * @param mixed $shippingAddress
     */
    public static function setShippingAddress($shippingAddress)
    {
        Session::put('checkout_shipping', $shippingAddress);
    }

    /**
     * @return mixed
     */
    public static function getShippingAddress()
    {
        return Session::get('checkout_shipping');
    }

    /**
     * @param mixed $shippingMethod
     */
    public static function setShippingMethod($shippingMethod)
    {
        Session::put('checkout_shipping_method', $shippingMethod);
    }

    /**
     * @return mixed
     */
    public static function getShippingMethod()
    {
        return Session::get('checkout_shipping_method');
    }

    /**
     * @param mixed $paymentInfo
     */
    public static function setPaymentInfo($paymentInfo)
    {
        Session::put('checkout_payment', $paymentInfo);
    }

    /**
     * @return mixed
     */
    public static function getPaymentInfo()
    {
        return Session::get('checkout_payment');
    }


    public static function getOrder()
    {
        return Session::get('checkout_order');
    }


    public static function saveCustomer($input)
    {
        if(Auth::check() && !\Goxob::isAdmin()) //if customer is logged in from frontend
        {
            $customer = Auth::user();
            static::setCustomer($customer);
        }
        else if(isset($input['customer_id']) && !empty($input['customer_id']))//chose customer from admin
        {
            $customer = \Goxob::getModel('customer/customer')->find($input['customer_id']);
            if(!isset($customer))
            {
                \Goxob::error(trans('Could not find customer'));
            }
            static::setCustomer($customer);
        }
        else//guest or register customer
        {
            $customerInfo['first_name'] = $input['billing_first_name'];
            $customerInfo['last_name'] = $input['billing_last_name'];
            $customerInfo['phone'] = $input['billing_phone'];
            $customerInfo['email'] = $input['customer_email'];

            $customer = \Goxob::getModel('customer/customer');
            if( !empty($input['password']) )//register customer
            {
                //bind data
                $customerInfo['password'] = $input['password'];
                $customerInfo['password_confirm'] = $input['password_confirm'];
                $customerInfo['status'] = 1;

                $customer->setData($customerInfo);
                if( !$customer->validate())
                {
                    return \Goxob::back($customer->getErrors());
                }
            }
            else{
                $customer->setData($customerInfo);
            }
            static::setCustomer($customer);
        }
    }


    public static function saveBilling($input)
    {
        $billingAddress = static::saveAddress($input);
        if(isset($billingAddress)){
            $billingAddress->type = 0;
            static::setBillingAddress($billingAddress);
        }
        if(isset($input['ship_from_bill']) && $input['ship_from_bill'] == 1){
            $shippingAddress = clone static::getBillingAddress();
            $shippingAddress->type = 1;
            static::setShippingAddress($shippingAddress);
        }
    }

    public static function saveShipping($input)
    {
        $shippingAddress = static::saveAddress($input, 'shipping');
        if(isset($shippingAddress)){
            $shippingAddress->type = 1;
            static::setShippingAddress($shippingAddress);
        }
    }

    protected static function saveAddress($input, $prefix = 'billing')
    {
        $customer = static::getCustomer();

        //existed address
        if(isset($input[$prefix.'_address_id']) && isset($input['new_'.$prefix.'_address']) && $input['new_'.$prefix.'_address'] == 0)
        {
            //from selection of existed address
            $address = \Goxob::getModel('customer/address')->find($input[$prefix.'_address_id']);
        }
        else if(!empty($input[$prefix.'_first_name']))//new address
        {
            //new address
            $addressInfo['first_name'] = $input[$prefix.'_first_name'];
            $addressInfo['last_name'] = $input[$prefix.'_last_name'];
            $addressInfo['phone'] = $input[$prefix.'_phone'];
            $addressInfo['address'] = $input[$prefix.'_address'];
            $addressInfo['city'] = $input[$prefix.'_city'];
            $addressInfo['state'] = $input[$prefix.'_state'];
            $addressInfo['zipcode'] = $input[$prefix.'_zipcode'];
            //$addressInfo['company'] = $input[$prefix.'_company'];
            //$addressInfo['country'] = $input[$prefix.'_country'];

            if(isset($customer->customer_id))//loggined customer
            {
                $addressInfo['customer_id'] = $customer->customer_id;
            }

            $address = \Goxob::getModel('customer/address');
            $address->setData($addressInfo);

            //set attempt data for ignore validate for required fields
            $address->type = 1;
            if(!isset($address->customer_id)){
                $address->customer_id = 1;
            }

            if( !$address->validate())
            {
                return \Goxob::back($address->getErrors());
            }

            //unset attempt data
            $address->type = null;
            if(isset($address->customer_id)){
                $address->customer_id = null;
            }
        }
        if(isset($address)){
            return $address;
        }
    }

    public static function saveShippingMethod($input)
    {
        if(!isset($input['shipping_method']))
        {
            $input['shipping_method'] = static::SHIPPING_METHOD_FREE;
        }
        if($input['shipping_method'] == static::SHIPPING_METHOD_FLAT)
        {
            $shippingMethod['shipping_price'] = 5;
        }

        $shippingMethod['shipping_method'] = $input['shipping_method'];
        static::setShippingMethod($shippingMethod);
    }

    public static function savePayment($input)
    {
        if(!isset($input['payment_method']))
        {
            $input['payment_method'] = static::PAY_METHOD_CASH;
        }
        else if($input['payment_method'] == "ccsave")
        {
            $paymentInfo['cc_name'] = $input['cc_name'];
            $paymentInfo['cc_type'] = $input['cc_type'];
            $paymentInfo['cc_number'] = $input['cc_number'];
            $paymentInfo['cc_expire_month'] = $input['cc_expire_month'];
            $paymentInfo['cc_expire_year'] = $input['cc_expire_year'];
            $paymentInfo['cc_cid'] = $input['cc_cid'];
        }
        $paymentInfo['payment_method'] = $input['payment_method'];
        static::setPaymentInfo($paymentInfo);
    }

    public static function flush()
    {
        Session::forget('checkout_customer');
        Session::forget('checkout_billing');
        Session::forget('checkout_shipping');
        Session::forget('checkout_shipping_method');
        Session::forget('checkout_payment');
        Session::forget('checkout_order');
    }

    public static function isExpired()
    {
        $customer = static::getCustomer();
        $billingAddress = static::getBillingAddress();
        $paymentInfo = static::getPaymentInfo();

        $cartProducts = Cart::getCartProducts();
        $cartTotalAmount = Cart::getTotalAmount();

        if(empty($customer)
            || empty($billingAddress)
            || empty($paymentInfo)
            || empty($cartProducts)
            || empty($cartTotalAmount)
        ){
            return true;
        }
        return false;
    }

    public static function saveAll($input)
    {
        static::saveCustomer($input);
        static::saveBilling($input);
        static::saveShipping($input);
        static::saveShippingMethod($input);
        static::savePayment($input);
    }

    public static function placeOrder($customer, $billingAddress, $shippingAddress, $shippingMethod, $paymentInfo, $cartProducts, $cartTotalAmount)
    {
        if(empty($customer)
            || empty($billingAddress)
            || empty($paymentInfo)
            || empty($cartProducts)
            || empty($cartTotalAmount)
        ){
            return \Goxob::warning(trans('Could not place order. Lack of information provided. Maybe session expired.'));
        }

        //store customer information
        static::storeCustomer($customer);

        //store billing, shipping address for customer
        static::storeBillShip($billingAddress, $shippingAddress);

        //store order
        $order = static::storeOrder($customer, $shippingMethod, $paymentInfo, $cartTotalAmount);
        if($order->hasErrors()){
            //delete customer, billing, shipping
            $customer->delete();
            $billingAddress->delete();
            $shippingAddress->delete();

            \Goxob::error('Storing order has error.'.$order->getErrors());
        }

        //store order items
        static::storeOrderItems($order, $cartProducts);

        //store billing, shipping address for order
        static::storeBillShipForOrder($billingAddress, $shippingAddress, $order);

        //increase product sold
        static::soldUpProductQuantity($cartProducts);

        //make purchase
        $waitForPurchase = static::makePurchase($paymentInfo, $order);
        if(!$waitForPurchase){
            //send email confirmation
            static::sendOrderEmail($customer, $order);
        }
    }

    protected static function storeCustomer($customer)
    {
        if( isset($customer->password))
        {
            if(!isset($customer->customer_id)){
                if (! $customer->save()) {
                    \Goxob::error($customer->getErrors());
                }
            }
            $billingAddress = static::getBillingAddress();
            $billingAddress->customer_id = $customer->customer_id;
            static::setBillingAddress($billingAddress);

            $shippingAddress = static::getShippingAddress();
            $shippingAddress->customer_id = $customer->customer_id;
            static::setShippingAddress($shippingAddress);
        }
    }

    //store billing, shipping address to db, return address id
    protected static function storeBillShip($billingAddress, $shippingAddress)
    {
        static::storeAddress($billingAddress);
        if(isset($shippingAddress)){
            static::storeAddress($shippingAddress);
        }
    }

    protected static function storeBillShipForOrder($billingAddress, $shippingAddress, $order)
    {
        $billingInfo = $billingAddress->toArray();
        $billingInfo['order_id'] = $order->order_id;
        $address = \Goxob::getModel('sale/address');
        $address->setData($billingInfo);
        if (!$address->save()) {
            \Goxob::error($address->getErrors());
        }

        if(isset($shippingAddress)){
            $shippingInfo = $shippingAddress->toArray();
            $shippingInfo['order_id'] = $order->order_id;

            $addressShip = \Goxob::getModel('sale/address');
            $addressShip->setData($shippingInfo);
            if (!$addressShip->save()) {
                \Goxob::error($addressShip->getErrors());
            }
        }
    }

    protected static function storeAddress(&$address)
    {
        if(!isset($address)){
            \Goxob::error(trans('Storing customer address has error. Empty address provided.'));
        }

        if(!isset($address->address_id) && isset($address->customer_id))
        {
            if (!$address->save()) {
                \Goxob::error($address->getErrors());
            }
        }
        return $address;
    }

    protected static function storeOrder($customer, $shippingMethod, $paymentInfo, $cartTotalAmount)
    {
        $orderData['order_time'] = date('Y-m-d H:i:s');
        $orderData['amount'] = $cartTotalAmount;
        $orderData['status'] = \Goxob\Sale\Helper\Order::STATUS_PENDING;
        if(isset($customer->customer_id))//logged in, registered customer
        {
            $orderData['customer_id'] = $customer->customer_id;
        }
        $orderData['customer_email'] = $customer->email;
        $orderData['customer_phone'] = $customer->phone;

        $orderData['payment_method'] = $paymentInfo['payment_method'];

        if(isset($shippingMethod)){
            $orderData['shipping_method'] = $shippingMethod['shipping_method'];
            if(isset($shippingMethod['shipping_price'])){
                $orderData['shipping_price'] = $shippingMethod['shipping_price'];
            }
        }

        $order = \Goxob::getModel('sale/order');
        $order->setData($orderData);
        if (!$order->save()) {
            //\Goxob::error('Storing order has error.'.$order->getErrors());
            return $order;
        }
        Session::put('checkout_order', $order);
        return $order;
    }

    protected static function storeOrderItems($order, $cartProducts)
    {
        if(!$order->saveProductItems($cartProducts))
        {
            \Goxob::error($order->getErrors());
        }
    }

    protected static function makePurchase($paymentInfo, $order)
    {
        if($paymentInfo['payment_method'] == static::PAY_METHOD_PAYPAL)
        {
            static::updateOrderStatus($order, \Goxob\Sale\Helper\Order::STATUS_PAYMENT_REVIEW);

            Redirect::to('paypal')->send();
            return true;
        }
        else{
            static::updateOrderStatus($order, \Goxob\Sale\Helper\Order::STATUS_PROCESSING);
            return false;
        }
    }

    protected static function soldUpProductQuantity($cartProducts)
    {
        foreach($cartProducts as $item)
        {
            //increase product sold
            $product = \Goxob::getModel('catalog/product')->find($item->product_id);
            $product->sold = $product->sold + $item->cart_qty;
            $product->save();
        }
    }

    protected static function updateOrderStatus($order, $status)
    {
        //update order status
        $order->status = $status;
        if (! $order->save()) {
            \Goxob::error($order->getErrors());
        }
    }

    public static function sendOrderEmail($customer, $order)
    {
        $recipient = $customer->email;
        $username = $customer->first_name.' '.$customer->last_name;

        if ( empty($recipient) ) {
            \Goxob::error(trans('Could not get customer email'));
        }

        $storeName = \Goxob::getSetting('store.store_name');
        $subject = $storeName.' Order Confirmation';

        $data['orderId'] = $order->order_id;
        $data['username'] = $username;

        return \Goxob\Core\Helper\Email::send('email.email_order_conf', $data, $recipient, $subject);
    }


    public static function getPaymentString($payment)
    {
        switch($payment)
        {
            case self::PAY_METHOD_CASH:
                return trans("CHECK_MONEY_ORDER");
            case self::PAY_METHOD_PAYPAL:
                return trans("PAYPAL");
            case self::PAY_METHOD_CREDIT:
                return trans("CREDIT_CARD");
            case self::PAY_METHOD_TRANSFER:
                return trans("BANK_TRANSFER");
        }
    }

}