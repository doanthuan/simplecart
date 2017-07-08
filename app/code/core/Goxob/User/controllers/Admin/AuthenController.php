<?php
namespace Goxob\User\Admin;

use Session, Redirect, View, Input;

use Goxob\User\Helper\Auth;

use Goxob\User\Helper\LoginValidator;

class AuthenController extends \Goxob\Core\Controller\BaseController {

    public function logout()
    {
        Auth::logout();
        Session::flush();
        return Redirect::to('admin/login');
    }

    public function login()
    {
        // If logged in, redirect to admin area
        if (Auth::check())
        {
            return Redirect::to( 'admin/login' );
        }

        return View::make('user.user.login');
    }

    public function postLogin()
    {
        $loginValidator = new LoginValidator( Input::all() );

        // Check if the form validates with success.
        if ( $loginValidator->passes() )
        {
            $loginDetails = array(
                'username' => Input::get('username'),
                'password' => Input::get('password')
            );

            // Try to log the user in.
            if ( Auth::attempt( $loginDetails ) )
            {
                $user = Auth::user();
                $user->last_login = date('Y-m-d H:i:s');
                $user->save();

                // Redirect to the dashboard
                return Redirect::intended('admin');
            }else{
                // Redirect to the login page.
                return Redirect::to('admin/login')->with('errors', trans( 'Invalid Username or Password' ) )
                    ->withInput(Input::except('password'));
            }
        }

        // Something went wrong.
        return Redirect::to('admin/login')->withErrors( $loginValidator->messages() )->withInput();
    }
}