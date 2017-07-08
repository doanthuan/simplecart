<?php
/**
 * Created by JetBrains PhpStorm.
 * User: thuan
 * Date: 5/26/14
 * Time: 4:47 PM
 * To change this template use File | Settings | File Templates.
 */

namespace Goxob\Translation;

use Session;


class Translator extends \Illuminate\Translation\Translator {
    public function parseKey($key)
    {
        $segments = explode('.', $key);
        if(count($segments) == 1)
        {
            $module = Session::get('current_module');
            $key = $module.'::global.'.$key;
        }
        if(strpos($key,"::") === false)
        {
            $module = Session::get('current_module');
            $key = $module.'::'.$key;
        }
        return parent::parseKey($key);
    }
}