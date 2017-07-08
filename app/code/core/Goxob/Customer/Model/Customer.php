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
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

use Hash;

class Customer extends Model implements UserInterface, RemindableInterface{

    protected $table = 'customer';
    protected $primaryKey = 'customer_id';
    public $timestamps = true;

    protected $fillable = array( 'first_name', 'last_name', 'email', 'phone', 'birthday',
        'gender', 'status', 'is_subscribed');

    protected $rules = array(
        'first_name' => 'required',
        'last_name' => 'required',
        'email' => 'required|email',
        'birthday' => 'date',
    );

    //relationship
    public function addresses()
    {
        return $this->hasMany('\Goxob\Customer\Model\Address', 'customer_id', 'customer_id');
    }

    public function orders()
    {
        return $this->hasMany('\Goxob\Sale\Model\Order', 'customer_id', 'customer_id');
    }


    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array('password');

    /**
     * Get the unique identifier for the user.
     *
     * @return mixed
     */
    public function getAuthIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->password;
    }

    /**
     * Get the e-mail address where password reminders are sent.
     *
     * @return string
     */
    public function getReminderEmail()
    {
        return $this->email;
    }

    public function getRememberToken()
    {
        return $this->remember_token;
    }

    public function setRememberToken($value)
    {
        $this->remember_token = $value;
    }

    public function getRememberTokenName()
    {
        return 'remember_token';
    }

    public function setData($input)
    {
        if(empty($input)){
            return;
        }

        if(!empty($input['password']))
        {
            $this->password = Hash::make($input['password']);
        }

        parent::setData($input);
    }

    public function validate()
    {
        if(parent::validate())
        {
            if($this->exists('email'))
            {
                $this->setErrors(trans('Customer email is already existed'));
                return false;
            }
            return true;
        }
        return false;
    }

    public function getFullName()
    {
        return $this->first_name.' '.$this->last_name;
    }
}