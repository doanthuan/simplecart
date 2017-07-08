<?php
namespace Goxob\Locale\Helper;


class Currency {

    protected static $defaultCurrency;

    public static function getDefaultCurrency()
    {
        //get default currency
        if(!isset(static::$defaultCurrency)){
            $defaultCurrency = \Goxob::getModel('locale/currency')->where('status', 1)->where('default', 1)->first();
            if(!isset($defaultCurrency)){
                $defaultCurrency = \Goxob::getModel('locale/currency')->where('status', 1)->first();
            }
            if(!isset($defaultCurrency)){
                return \Goxob::error(trans('Please setup default currency'));
            }
            static::$defaultCurrency = $defaultCurrency;
        }
        return static::$defaultCurrency;
    }

    public static function getDefaultCurrencyCode()
    {
        $defaultCurrency = static::getDefaultCurrency();
        return $defaultCurrency->code;
    }

    public static function getPrice($value)
    {
        $defaultCurrency = static::getDefaultCurrency();

        $resultValue =  $value * $defaultCurrency->value;

        if(static::$defaultCurrency->code == 'VND'){
            $resultValue = number_format($resultValue, $defaultCurrency->decimal_place, ',', '.');
        }
        else{
            $resultValue = number_format($resultValue, $defaultCurrency->decimal_place);
        }

        return $resultValue;
    }

    public static function formatPrice($value)
    {
        $resultValue = static::getPrice($value);

        $resultValue = static::$defaultCurrency->symbol_left. $resultValue. static::$defaultCurrency->symbol_right;
        return $resultValue;
    }

    public static function priceToNumber($price)
    {
        $defaultCurrency = static::getDefaultCurrency();

        $number = static::priceToFloat($price);

        $resultValue =  $number / $defaultCurrency->value;

        return $resultValue;
    }

    public static function priceToFloat($price)
    {
        static::getDefaultCurrency();

        // convert "," to "."
        $price = str_replace(',', '.', $price);

        // remove everything except numbers and dot "."
        $price = preg_replace("/[^0-9\.]/", "", $price);

        // remove all seperators from first part and keep the end
        $price = str_replace('.', '',substr($price, 0, - (static::$defaultCurrency->decimal_place + 1) )) . substr($price, -(static::$defaultCurrency->decimal_place + 1));

        // return float
        return (float) $price;
    }

}