<?php

namespace Goxob\Sale\Model;


class Address extends \Goxob\Core\Model\Model{

    protected $table = 'order_address';
    protected $primaryKey = 'address_id';

    protected $fillable = array( 'first_name', 'last_name', 'company', 'phone', 'fax', 'address',
        'city', 'state', 'zipcode', 'country', 'type', 'order_id');

    protected $rules = array(
        'first_name' => 'required',
        'last_name' => 'required',
        'address' => 'required',
        'type' => 'required',
        'order_id' => 'required',
    );

    //relationships
    public function order()
    {
        return $this->belongsTo('\Goxob\Sale\Model\Order');
    }

    public function validate()
    {
        if(parent::validate())
        {
//            if($this->exists('phone'))
//            {
//                $this->setErrors(trans('Address phone is already existed'));
//                return false;
//            }
            return true;
        }
        return false;
    }
}