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

class AttributeSet extends Model{

    protected $table = 'attribute_set';
    protected $primaryKey = 'attr_set_id';

    protected $fillable = array( 'name' );

    protected $rules = array(
        'name'=>'required'
    );

    public function attributes()
    {
        return $this->hasMany('\Goxob\Catalog\Model\Attribute', 'attr_set_id', 'attr_set_id');
    }

    public function products()
    {
        return $this->hasMany('\Goxob\Catalog\Model\Product', 'attr_set_id', 'attr_set_id');
    }

    public function getIdByName($name)
    {
        return $this->where('name', $name)->first()->attr_set_id;
    }

    public function validate()
    {
        if(parent::validate())
        {
            if($this->exists('name'))
            {
                $this->setErrors(trans('AttributeSet name is already existed'));
                return false;
            }
            return true;
        }
        return false;
    }
}