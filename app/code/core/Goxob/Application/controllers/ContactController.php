<?php
namespace Goxob\Application;

use Illuminate\Support\Facades\Redirect;
use View, Input, Validator;

class ContactController extends \Goxob\Core\Controller\BaseController {

	public function index()
	{
        return View::make('application.contact.index');
	}

    public function postContact()
    {
        $input = Input::all();

        //validate captcha
        $rules =  array('captcha' => array('required', 'captcha'));
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails())
        {
            return \Goxob::back(trans('Captcha does not match'));
        }

        $adminEmail = \Goxob::getSetting('store.admin_email');
        $recipient = $adminEmail;
        $storeName = \Goxob::getSetting('store.store_name');
        $subject = $storeName.' Contact Us';

        $data = $input;



        \Goxob\Core\Helper\Email::send('email.email_contact', $data, $recipient, $subject);

        return Redirect::to('contact')->with('message', trans('Your contact information was sent successfully!'));
    }

}