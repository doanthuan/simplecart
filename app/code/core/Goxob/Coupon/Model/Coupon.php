<?php
namespace Goxob\Coupon\Model;

use Goxob\Core\Model\Model;
use DB, Input, Str, Validator, File;

class Coupon extends Model{

    protected $table = 'coupon';
    protected $primaryKey = 'coupon_id';
    public $timestamps = true;

    protected $fillable = array( 'name', 'code', 'type', 'discount', 'free_shipping', 'total_above',
        'date_start', 'date_end', 'uses_total', 'status');

    protected $rules = array(
        'name'       => 'required',
        'code'        => 'required',
        'type'     =>   'required',
        'discount'     =>  'required|numeric',
    );

    //relationships
    public function products()
    {
        return $this->belongsToMany('\Goxob\Catalog\Model\Product', 'coupon_product', 'coupon_id', 'product_id');
    }

    public function validate()
    {
        if(parent::validate())
        {
            if($this->exists(array('code')))
            {
                $this->setErrors(trans('Coupon code is already existed'));
                return false;
            }

            if($this->exists(array('name')))
            {
                $this->setErrors(trans('Coupon name is already existed'));
                return false;
            }

            return true;
        }
        return false;
    }



}