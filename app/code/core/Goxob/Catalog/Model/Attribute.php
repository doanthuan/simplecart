<?php
/**
 * Created by JetBrains PhpStorm.
 * User: thuan
 * Date: 4/29/14
 * Time: 8:39 AM
 * To change this template use File | Settings | File Templates.
 */

namespace Goxob\Catalog\Model;

use Goxob\Core\Model\Model;

class Attribute extends Model{

    protected $table = 'attribute';
    protected $primaryKey = 'attr_id';

    protected $fillable = array( 'code', 'label', 'type', 'attr_set_id', 'sort_order', 'options', 'gui_edit', 'gui_display'
    );

    protected $rules = array(
        'code'=>'required'
    );

    //relationships
    public function products()
    {
        return $this->belongsToMany('\Goxob\Catalog\Model\Product', 'product_attribute_value', 'attr_id', 'product_id');
    }

    public function attributeSet()
    {
        return $this->belongsTo('\Goxob\Catalog\Model\AttributeSet');
    }

    public function setData($input)
    {
        if(!empty($input['options']))
        {
            $filterOptions = array();
            $options = explode(';', $input['options']);
            foreach($options as $option)
            {
                $option = trim($option);
                if(empty($option))continue;

                $filterOptions[] = trim($option);
            }
            $input['options'] = implode(';', $filterOptions);
        }

        parent::setData($input);
    }

    public function validate()
    {
        if(parent::validate())
        {
            if($this->exists('code'))
            {
                $this->setErrors(trans('Attribute code already exists'));
                return false;
            }
            return true;
        }
        return false;
    }
}