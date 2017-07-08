<?php

namespace Goxob\User\Helper;

use Session, Hash;

class Auth {

    public static function user()
    {
        return Session::get('admin.auth');
    }

    public static function logout()
    {
        Session::forget('admin.auth');
    }

    public static function check()
    {
        if(Session::has('admin.auth'))
        {
            return true;
        }
        return false;
    }

    public static function attempt($credentials)
    {
        $username = $credentials['username'];
        $password = $credentials['password'];

        $user = \Goxob::getModel('user/user');
        if($user->checkLogin($username, $password))
        {
            if (Hash::needsRehash($user->password))
            {
                $hashed = Hash::make($password);
                $user->password = $hashed;
            }

            Session::put('admin.auth', $user);
            return true;
        }
        return false;
    }
}