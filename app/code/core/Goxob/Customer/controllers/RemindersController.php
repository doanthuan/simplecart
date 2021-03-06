<?php
namespace Goxob\Customer;

use Auth, Session, Redirect, View, Input, Password, App, Hash;

class RemindersController extends \Goxob\Core\Controller\BaseController {

	/**
	 * Display the password reminder view.
	 *
	 * @return Response
	 */
	public function getRemind()
	{
		return View::make('customer.auth.remind');
	}

	/**
	 * Handle a POST request to remind a user of their password.
	 *
	 * @return Response
	 */
	public function postRemind()
	{
        $response = Password::remind(Input::only('email'), function($message)
        {
            $message->subject('Goxob Password Reminder');
            $message->from('oldfox1986@gmail.com');
        });


		switch ($response)
		{
			case Password::INVALID_USER:
				return Redirect::back()->with('errors', trans($response));

			case Password::REMINDER_SENT:
				return Redirect::back()->with('message', trans($response));
		}
	}

	/**
	 * Display the password reset view for the given token.
	 *
	 * @param  string  $token
	 * @return Response
	 */
	public function getReset($token = null)
	{
		if (is_null($token)) App::abort(404);

		return View::make('customer.auth.reset')->with('token', $token);
	}

	/**
	 * Handle a POST request to reset a user's password.
	 *
	 * @return Response
	 */
	public function postReset()
	{
		$credentials = Input::only(
			'email', 'password', 'password_confirmation', 'token'
		);

		$response = Password::reset($credentials, function($user, $password)
		{
			$user->password = Hash::make($password);

			$user->save();
		});

		switch ($response)
		{
			case Password::INVALID_PASSWORD:
			case Password::INVALID_TOKEN:
			case Password::INVALID_USER:
				return Redirect::back()->with('error', trans($response));

			case Password::PASSWORD_RESET:
				return Redirect::to('/')->with('message', trans('Reset password successfully!'));
		}
	}

}
