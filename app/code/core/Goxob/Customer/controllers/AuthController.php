<?php
namespace Goxob\Customer;

use Auth, Session, Redirect, View, Input, Request;

use Goxob\Customer\LoginValidator;

class AuthController extends \Goxob\Core\Controller\BaseController {

    public function logout()
    {
        Auth::logout();
        Session::flush();
        return Redirect::to('login');
    }

    public function login()
    {
        // If logged in, redirect customer
        if (Auth::check())
        {
            return Redirect::to( '/' );
        }

        return View::make('customer.auth.login');
    }

    public function postLogin()
    {
        $loginValidator = new LoginValidator( Input::all() );

        // Check if the form validates with success.
        if ( $loginValidator->passes() )
        {
            $loginDetails = array(
                'email' => Input::get('email'),
                'password' => Input::get('password')
            );

            // Try to log the user in.
            if ( Auth::attempt( $loginDetails ) )
            {
                $user = Auth::user();

                if(empty($user->status)){
                    Auth::logout();
                    return Redirect::to('login')->with('errors', trans( 'This account has been locked' ) )
                        ->withInput(Input::except('password'));
                }

                $user->last_login = date('Y-m-d H:i:s');
                $user->save();

                // Redirect history back
                $backUrl = Input::get('back_url');
                if(isset($backUrl)){
                    return Redirect::to($backUrl);
                }

                return Redirect::to('customer');
            }else{
                // Redirect to the login page.
                return Redirect::to('login')->withErrors( trans( 'Invalid Email or Password' ) )
                    ->withInput(Input::except('password'));
            }
        }

        // Something went wrong.
        return Redirect::to('login')->withErrors( $loginValidator->messages() )->withInput();
    }

    public function register()
    {
        return View::make('customer.auth.register');
    }

    public function postRegister()
    {
        $input = Input::all();

        //store item to db
        $customer = \Goxob::getModel('customer/customer');
        $customer->setData($input);
        if(!$customer->save())
        {
            return Redirect::back()->withErrors($customer->getErrors())->withInput();
        }

        return Redirect::to('/')->with('message', trans('Thank you for your registering!'));
    }
}