<?php
namespace Goxob\Customer;

use View, Input, Session, Redirect, Route, Request, Form, Event, File, Validator, Str, Lang, Response, Auth;

class AddressController extends \Goxob\Core\Controller\BaseController {

    public function __construct()
    {
        parent::__construct();

        $this->beforeFilter('auth');
    }

    public function index()
    {
        //get all address of customers;
        $customer = Auth::user();
        $addresses = $customer->addresses()->get();

        $data['addresses'] = $addresses;
        return View::make('customer.address.index', $data);
    }

    public function edit($id)
    {
        $address = \Goxob::getModel('customer/address')->find($id);
        if(is_null($address))
        {
            throw new \Exception('Could not find address');
        }
        $data['address'] = $address;

        return View::make('customer.address.edit', $data);
    }

    public function store()
    {
        $input = Input::all();

        //store item to db
        $address = \Goxob::getModel('customer/address');
        $address->setData($input);
        if(!$address->save())
        {
            return Redirect::back()->withErrors($address->getErrors())->withInput();
        }

        return Redirect::to('customer/address')->with('message', trans('Address saved').'!');
    }

    public function delete()
    {
        $addressId = Input::get('address_id');
        $address = \Goxob::getModel('customer/address');
        if(!$address->destroy($addressId))
        {
            return Redirect::back()->withErrors($address->getErrors());
        }
        return Redirect::to('customer/address')->with('message', trans('Deleting address successfully!'));
    }
}