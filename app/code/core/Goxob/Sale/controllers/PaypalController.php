<?php
namespace Goxob\Sale;

use View, Input, Redirect, Session, Auth, Controller;

class PaypalController extends \Goxob\Core\Controller\BaseController {

    protected $ignoreCsrf = true;

    public function index()
    {
        if(Helper\Checkout::isExpired()){
            \Goxob::warning(trans('Session timeout.'));
        }
        $customer = Helper\Checkout::getCustomer();
        $billing = Helper\Checkout::getBillingAddress();

        $products = Helper\Cart::getCartProducts();

        $data['billing'] = $billing;
        $data['customer'] = $customer;
        $data['products'] = $products;

        return View::make('sale.paypal.standard', $data);
    }

    public function paypalReturn()
    {
        if(Helper\Checkout::isExpired()){
            \Goxob::warning(trans('Session timeout.'));
        }
        $customer = Helper\Checkout::getCustomer();
        $order = Helper\Checkout::getOrder();

        Helper\Checkout::sendOrderEmail($customer, $order);

        return Redirect::to('checkout/success');
    }

    public function paypalNotify()
    {
        header('HTTP/1.1 200 OK');

        $result = \Goxob\Sale\Helper\Paypal::verifyIPN($_POST);
        if (!$result)
        {
            \Goxob\Core\Helper\Email::send('email.paypal.paypal_ipn_fake', array('txn_id' => $_POST['txn_id']), 'doanvuthuan@gmail.com', trans('Fake IPN Received') );
            exit;
        }

        switch ($_POST['payment_status'])
        {
            case "Completed":
                break;
            case "Pending":
                $payerEmail = $_POST['payer_email'];
                \Goxob\Core\Helper\Email::send('email.paypal.paypal_ipn_pending', array() , $payerEmail, trans('Order Received') );
                exit;
                break;
            default:
                $data['error'] = $result;
                \Goxob\Core\Helper\Email::send('email.paypal.paypal_ipn_unknown', $data, 'doanvuthuan@gmail.com', trans('IPN Received') );
                exit;
        }

        //Step 2. Confirm Product Information
        $result = \Goxob\Sale\Helper\Paypal::confirmProduct($_POST);
        if ($result == false)
        {
            \Goxob\Core\Helper\Email::send('email.paypal.paypal_ipn_mismatch', array(), 'doanvuthuan@gmail.com', trans('Product Name/ID/Price mis-match') );
            exit;
        }

    }

    public function testLog()
    {
        file_put_contents(storage_path().'/log.txt', 'abc');
        file_put_contents(storage_path().'/log.txt', 'fet', FILE_APPEND);
        file_put_contents(storage_path().'/log.txt', 'dgw', FILE_APPEND);
    }

    public function testVerifyIPN()
    {
        if(Helper\Checkout::isExpired()){
            \Goxob::warning(trans('Session timeout.'));
        }
        $customer = Helper\Checkout::getCustomer();
        $billing = Helper\Checkout::getBillingAddress();

        $products = Helper\Cart::getCartProducts();

        $data['billing'] = $billing;
        $data['customer'] = $customer;
        $data['products'] = $products;

        return View::make('sale.paypal.test-ipn', $data);
    }

}