<?php

namespace Goxob\Catalog\Helper;

use Form;

class Attribute {

    const TYPE_TEXTBOX = 1;
    const TYPE_TEXTAREA = 2;
    const TYPE_DATETIME = 3;
    const TYPE_CHECKBOX = 4;
    const TYPE_DROPDOWN = 5;
    const TYPE_MULTISELECT = 6;
    const TYPE_MULTIRADIO = 7;
    const TYPE_FILE = 8;

    public static function getTypeString($type)
    {
        switch($type)
        {
            case static::TYPE_TEXTBOX:
                return "TextBox";
            case static::TYPE_TEXTAREA:
                return "TextArea";
            case static::TYPE_DATETIME:
                return "DateTime";
            case static::TYPE_CHECKBOX:
                return "Checkbox";
            case static::TYPE_DROPDOWN:
                return "DropDown";
            case static::TYPE_MULTISELECT:
                return "MultiSelect";
            case static::TYPE_MULTIRADIO:
                return "MultiRadio";
            case static::TYPE_FILE:
                return "File";

            case 10:
                return "Custom";
            default:
                return "TextBox";
        }
    }

    public static function getTypeList()
    {
        $result = array();
        for($i = 1; $i <= static::TYPE_MULTISELECT; $i++)
        {
            $result[$i] = self::getTypeString($i);
        }
        return $result;
    }

    public static function renderAttribute($item)
    {
        $name = 'attr_name_'.$item->attr_id;

        $label = $item->label;

        $value = isset($item->attr_value)?$item->attr_value:'';

        switch ($item->type) {
            case static::TYPE_TEXTBOX:
                $html = Form::row('text', $label, $name, $value);
                break;
            case static::TYPE_TEXTAREA:
                $html = Form::row('textarea', $label, $name, $value);
                break;
            case static::TYPE_DATETIME:
                $html = Form::row('text', $label, $name, $value, array('class'=>'form-control datepicker'));
                break;
            case static::TYPE_CHECKBOX:
                $html = Form::row('checkbox', $label, $name, $value);
                break;
            case static::TYPE_DROPDOWN:
                $options = explode(";", $item->options);

                $html = Form::row('dropdown', $label, $name, $value, null,
                    array(
                        'collection' => $options
                    )
                );
                break;
            case static::TYPE_MULTISELECT:
                $options = explode(";", $item->options);
                $value = explode(";", $value);

                $name = $name.'[]';
                $html = Form::row('dropdown', $label, $name, $value, array('multiple' => 'multiple'),
                    array(
                        'collection' => $options
                    )
                );
                break;
        }
        return $html;
    }
}