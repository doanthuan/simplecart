<?php
/**
 * Created by JetBrains PhpStorm.
 * User: thuan
 * Date: 4/29/14
 * Time: 8:39 AM
 * To change this template use File | Settings | File Templates.
 */
namespace Goxob\User\Model;

use Goxob\Core\Model\Model;

use Hash, View;

class User extends Model{

    protected $table = 'user';
    protected $primaryKey = 'user_id';
    public $timestamps = true;

    protected $fillable = array( 'role_id', 'username', 'first_name', 'last_name', 'email', 'status');

    protected $rules = array(
        'username' => 'required',
        'email' => 'required|email',
        'role_id' => 'required',
    );

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
            if($this->exists('username'))
            {
                $this->setErrors(trans('Username is already existed'));
                return false;
            }

            if($this->exists('email'))
            {
                $this->setErrors(trans('Customer email is already existed'));
                return false;
            }
            return true;
        }
        return false;
    }

    public function checkLogin($username, $password)
    {
        $user = static::where('username', $username)->first();

        if (!Hash::check($password, $user->password))
        {
            return false;
        }

        if(!is_null($user))
        {
            $this->setData($user->getAttributes());
            return true;
        }
        return false;
    }
}