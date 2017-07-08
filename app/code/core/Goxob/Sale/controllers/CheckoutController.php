<?php
namespace Goxob\Sale;

use View, Input, Redirect, Session, Auth;

class CheckoutController extends \Goxob\Core\Controller\BaseController {

    public function __construct()
    {
        parent::__construct();

        $this->beforeFilter('hasCart');
    }

	public function index()
	{
        $data = array();
        //get existed customer address
        $customer = Auth::user();
        if($customer){
            $billingAddresses = $customer->addresses()->where('type', 0)->get();
            $shippingAddresses = $customer->addresses()->where('type', 1)->get();

            $data['billingAddresses'] = $billingAddresses;
            $data['shippingAddresses'] = $shippingAddresses;
        }

        $products = Helper\Cart::getCartProducts();
        $totalAmount = Helper\Cart::getTotalAmount();

        $data['products'] = $products;
        $data['totalAmount'] = $totalAmount;

        return View::make('sale.checkout.index', $data);
	}

    //Save customer, billing, shipping, payment information to session
    public function saveCheckout()
    {
        $input = Input::all();

        Helper\Checkout::saveAll($input);

        //go to review page
        return Redirect::to('checkout/review');
    }

    public function saveAccountBilling()
    {
        $input = Input::all();

        Helper\Checkout::saveCustomer($input);

        Helper\Checkout::saveBilling($input);

        return 'success';
    }

    public function saveShipping()
    {
        $input = Input::all();

        Helper\Checkout::saveShipping($input);
        return 'success';
    }

    public function saveShippingMethod()
    {
        $input = Input::all();

        Helper\Checkout::saveShippingMethod($input);
        return 'success';
    }

    public function savePayment()
    {
        $input = Input::all();

        Helper\Checkout::savePayment($input);

        return 'success';
    }

    public function placeOrder()
    {
        //make place order
        $customer = Helper\Checkout::getCustomer();
        $billingAddress = Helper\Checkout::getBillingAddress();
        $shippingAddress = Helper\Checkout::getShippingAddress();
        $shippingMethod = Helper\Checkout::getShippingMethod();
        $paymentInfo = Helper\Checkout::getPaymentInfo();

        $cartProducts = Helper\Cart::getCartProducts();
        $cartTotalAmount = Helper\Cart::getTotalAmount();

        Helper\Checkout::placeOrder($customer, $billingAddress, $shippingAddress, $shippingMethod, $paymentInfo, $cartProducts, $cartTotalAmount);

        //redirect to success page
        return Redirect::to('checkout/success');
    }

    public function cancelOrder()
    {
        //clear checkout session
        Helper\Checkout::flush();

        //redirect to home
        return Redirect::to('');
    }

    public function success()
    {
        $order = Helper\Checkout::getOrder();

        //clear checkout, cart session
        Helper\Checkout::flush();
        Helper\Cart::flush();

        return View::make('sale.checkout.success', array('orderId' => $order->order_id));
    }

}