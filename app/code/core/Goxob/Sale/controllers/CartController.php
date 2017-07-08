<?php
namespace Goxob\Sale;

use View, Input, Redirect, Session;

class CartController extends \Goxob\Core\Controller\BaseController {

    public function __construct()
    {
        parent::__construct();

        $this->beforeFilter('hasCart', array('except' => array('index','add') ));
    }

	public function index()
	{
        $products = Helper\Cart::getCartProducts();
        $totalAmount = Helper\Cart::getTotalAmount();
        $data['products'] = $products;
        $data['totalAmount'] = $totalAmount;
        return View::make('sale.cart.index', $data);
	}

    public function add()
    {
        $cartProducts = Session::get('cart_products', array());

        $productId = Input::get('product_id', 0);
        $quantity = Input::get('quantity', 1);

        //check product existed
        $product = \Goxob::getModel('catalog/product')->find($productId);
        if(!isset($product))
        {
            return Redirect::back()->withErrors(trans('Could not find product'))->withInput();
        }

        //validate quantity number
        if(!ctype_digit($quantity))
        {
            return Redirect::back()->withErrors(trans('Cart quantity is invalid'))->withInput();
        }

        //validate quantity with stock
        if( ($product->quantity - $product->sold) < $quantity)
        {
            return Redirect::back()->withErrors(trans('Cart quantity exceed stock'))->withInput();
        }

        //if product not existed in cart session, add it to cart
        if($productId > 0 && !array_key_exists($productId, $cartProducts))
        {
            $cartProducts[$productId] = $quantity;
            Session::put('cart_products', $cartProducts);
        }

        return Redirect::to('cart');
    }

    public function update()
    {
        $cartProducts = Session::get('cart_products', array());
        $cartQtyArr = Input::get('cart_qty', array());

        $i = 0;
        foreach($cartProducts as $id => $quantity)
        {
            //validate quantity
            if(!ctype_digit($cartQtyArr[$i]))
            {
                return Redirect::back()->withErrors(trans('Cart quantity is invalid'))->withInput();
            }
            $cartProducts[$id] = $cartQtyArr[$i];
            $i++;
        }
        Session::put('cart_products', $cartProducts);

        return Redirect::to('cart');
    }

    public function remove()
    {
        $cartProducts = Session::get('cart_products', array());
        $productId = Input::get('product_id',  0);
        if(array_key_exists($productId ,$cartProducts))
        {
            unset($cartProducts[$productId]);
            Session::put('cart_products', $cartProducts);
        }

        return Redirect::to('cart');
    }

    public function removeAll()
    {
        Session::forget('cart_products');

        return Redirect::to('cart');
    }
}