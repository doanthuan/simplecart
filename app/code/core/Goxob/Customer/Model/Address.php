<?php
/**
 * Created by JetBrains PhpStorm.
 * User: thuan
 * Date: 4/29/14
 * Time: 8:39 AM
 * To change this template use File | Settings | File Templates.
 */
namespace Goxob\Customer\Model;

use Goxob\Core\Model\Model;

class Address extends Model{

    protected $table = 'customer_address';
    protected $primaryKey = 'address_id';

    protected $fillable = array( 'first_name', 'last_name', 'company', 'phone', 'fax', 'address',
        'city', 'state', 'zipcode', 'country', 'type', 'customer_id');

    protected $rules = array(
        'first_name' => 'required',
        'last_name' => 'required',
        'address' => 'required',
        'type' => 'required',
        'customer_id' => 'required',
    );

    //relationships
    public function customer()
    {
        return $this->belongsTo('\Goxob\Customer\Model\Customer');
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