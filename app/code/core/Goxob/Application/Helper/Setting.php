<?php

namespace Goxob\Application\Helper;


class Setting {

    protected static $_settings;

    protected static function init()
    {
        $rows = \Goxob::getModel('application/setting')->all();

        foreach($rows as $row)
        {
            self::$_settings[$row->group][$row->key] = $row->value;
        }
    }

    public static function get($key, $default = null)
    {
        if(self::$_settings == null)
        {
            self::init();
        }

        list($group, $key) = explode(".", $key);

        if(isset(self::$_settings[$group][$key])){
            return self::$_settings[$group][$key];
        }
        else if(isset($default)){
            return $default;
        }
    }
}