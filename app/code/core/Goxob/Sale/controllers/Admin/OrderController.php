<?php
namespace Goxob\Sale\Admin;

use Goxob\Core\Helper\Data;
use Goxob\Core\Html\Toolbar;
use Goxob\Sale\Helper\Order;

use View, Input, Session, Redirect, Route, Request, Form, Event, File, Validator, Str, Lang;

class OrderController extends \Goxob\Core\Controller\AdminController {

    public function index()
    {
        Toolbar::title(trans('Manage Orders'));
        Toolbar::buttons(array(Toolbar::BUTTON_CREATE, Toolbar::BUTTON_DELETE));

        Toolbar::clickButton('Complete', 'updateOrderStatus(\''.Order::STATUS_COMPLETE.'\')');
        Toolbar::clickButton('Cancel', 'updateOrderStatus(\''.Order::STATUS_CANCEL.'\')');
        Toolbar::clickButton('Hold', 'updateOrderStatus(\''.Order::STATUS_ONHOLD.'\')');

        return View::make($this->module.'.'.$this->viewKey.'.index');
    }

    public function store()
    {
        $cartItems = $this->getCartItems();
        \Goxob\Sale\Helper\Cart::setCartItems($cartItems);

        $cartProducts = \Goxob\Sale\Helper\Cart::getCartProducts();
        $cartTotalAmount = \Goxob\Sale\Helper\Cart::getTotalAmount();

        $input = Input::all();
        \Goxob\Sale\Helper\Checkout::saveAll($input);

        $customer = \Goxob\Sale\Helper\Checkout::getCustomer();
        $billingAddress = \Goxob\Sale\Helper\Checkout::getBillingAddress();
        $shippingAddress = \Goxob\Sale\Helper\Checkout::getShippingAddress();
        $shippingMethod = \Goxob\Sale\Helper\Checkout::getShippingMethod();
        $paymentInfo = \Goxob\Sale\Helper\Checkout::getPaymentInfo();

        \Goxob\Sale\Helper\Checkout::placeOrder($customer, $billingAddress, $shippingAddress, $shippingMethod,
            $paymentInfo, $cartProducts, $cartTotalAmount);

        return Redirect::to('admin/sale/order/')->with('message', trans('Create order successfully!'));
    }

    protected function getCartItems()
    {
        $cartItems = array();
        $input = Input::all();

        $productIds = $input['product_ids'];
        $quantities = $input['quantity'];
        foreach($productIds as $i => $productId)
        {
            $cartItems[$productId] = $quantities[$i];
        }
        return $cartItems;
    }

    public function detail($id)
    {
        Toolbar::title(trans('Order Detail'));
        Toolbar::buttons(array(Toolbar::BUTTON_BACK)) ;

        return View::make('sale.order.order-detail', array('orderId' => $id));
    }

    public function updateStatus()
    {
        $cid = Input::get('cid');
        $value = Input::get('params');
        if (empty($cid))
        {
            return Redirect::back()->withErrors(trans('No '.$this->viewKey.' selected'));
        }

        // update status
        if (!$this->model->updateStatus($cid, $value))
        {
            return Redirect::back()->withErrors(trans('Error update orders status'));
        }

        return Redirect::to('admin/sale/order')->with('message', trans('Orders status updated!'));
    }
}