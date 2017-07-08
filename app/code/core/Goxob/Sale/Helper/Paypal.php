<?php
/**
 * Created by JetBrains PhpStorm.
 * User: thuan
 * Date: 7/7/14
 * Time: 4:20 PM
 * To change this template use File | Settings | File Templates.
 */

namespace Goxob\Sale\Helper;


class Paypal {

    public static function verifyIPN($data)
    {
        $postdata = "";
        $response = array();

        foreach($data as $var=>$val)
        {
            $postdata .= $var . "=" . urlencode($val) . "&";
        }
        $postdata.="cmd=_notify-validate";

        $fp = @fsockopen("ssl://www.sandbox.paypal.com" ,"443",$errnum,$errstr,30);
        if(!$fp)
        {
            return "$errnum: $errstr";
        } else
        {
            fputs($fp, "POST /cgi-bin/webscr HTTP/1.1\r\n");
            fputs($fp, "Host: www.sandbox.paypal.com\r\n");
            fputs($fp, "Content-type: application/x-www-form-urlencoded\r\n");
            fputs($fp, "Content-length: ".strlen($postdata)."\r\n");
            fputs($fp, "Connection: close\r\n\r\n");
            fputs($fp, $postdata . "\r\n\r\n");
            while(!feof($fp)) { $response[]=@fgets($fp, 1024); }
            fclose($fp);

            $response = implode("\n", $response);
        }

        if(strpos($response, "VERIFIED") !== false)
        {
            return true;
        }else
        {
            return false;
        }
    }

    public static function confirmProduct($input)
    {
        $numOfItems = $input['num_cart_items'];
        for($i = 1; $i <= $numOfItems; $i++){
            $productId = null;
            $quantity =  null;
            $amount = null;
            if(isset($input['item_number'.$i]) && isset($input['quantity'.$i]) && isset($input['mc_gross_'.$i])){
                $productId = $input['item_number'.$i];
                $quantity = $input['quantity'.$i];
                $amount = $input['mc_gross_'.$i];

                $product = \Goxob::getModel('catalog/product')->find($productId);
                if(!isset($product)){
                    return false;
                }
                if($product->product_id != $productId || $amount != ($product->price * $quantity)){
                    return false;
                }
            }
            else{
                return false;
            }
        }
        return true;
    }
}