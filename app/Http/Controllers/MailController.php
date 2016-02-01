<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Mail;

class MailController extends Controller
{
    public function contactMail(Request $request) {
    	$this->validate($request, [
                        'name' => 'required|max:20',
                        'email' => 'required|email',
                        'message' => 'required|max:1000'
            ]);

    	$name = $request->name;
    	$email = $request->email;
    	$body = $request->message;
    	$all = $request->all();

    	try {
    		Mail::send('emails.contact', ['name' => $name, 'email' => $email, 'body' => $body], function ($m) use ($all) {
	    		$m->from('info@openmanage.co.za', 'Airbook Contact Form');
	    		$m->to('dojapopoola@gmail.com', 'Kay')->subject('New Contact from Airbook!');
    		});

    		return redirect('/');
    	}

    	catch (Exception $e) {
    		$request->session()->flash('status', 'Mail could not be sent: ' .$e->getMessage(). ' Please try again!');
			return redirect('/contact');
    	}
    }
}
