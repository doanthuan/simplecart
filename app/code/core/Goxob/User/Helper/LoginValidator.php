<?php namespace Goxob\User\Helper;

use Goxob\Core\ValidatorBase;

class LoginValidator extends ValidatorBase
{
    protected $rules = array(
        'username'         =>  'required',
        'password'      =>  'required'
    );

}