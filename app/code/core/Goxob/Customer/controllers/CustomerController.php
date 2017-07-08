<?php
namespace Goxob\Customer;

use View, Input, Session, Redirect, Route, Request, Form, Event, File, Validator, Str, Lang, Response, Auth;

class CustomerController extends \Goxob\Core\Controller\BaseController {

    public function __construct()
    {
        parent::__construct();

        $this->beforeFilter('auth');
    }

    public function index()
    {
        $customer = Auth::user();

        $data['customer'] = $customer;
        return View::make('customer.customer.index', $data);
    }

    public function saveAccount()
    {
        $input = Input::all();

        $customer = \Goxob::getModel('customer/customer')->find($input['customer_id']);
        $customer->setData($input);
        if(!$customer->save())
        {
            return Redirect::back()->withErrors($customer->getErrors())->withInput();
        }

        return Redirect::to('customer')->with('message', trans('Your account information was saved successfully'));
    }

    public function address()
    {
        //get all address of customers;
        $customer = Auth::user();
        $addresses = $customer->addresses()->get();

        $data['addresses'] = $addresses;
        return View::make('customer.customer.address', $data);
    }

    public function orderHistory()
    {
        //get orders of customers;
        $customer = Auth::user();
        $orders = $customer->orders()->get();
        $data['orders'] = $orders;
        return View::make('customer.customer.order', $data);
    }

    public function orderDetail($id)
    {
        return View::make('customer.customer.order-detail', array('orderId' => $id));
    }
}