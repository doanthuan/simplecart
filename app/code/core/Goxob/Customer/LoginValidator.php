<?php namespace Goxob\Customer;

use Goxob\Core\ValidatorBase;

class LoginValidator extends ValidatorBase
{
    protected $rules = array(
        'email'         =>  'required',
        'password'      =>  'required'
    );

}