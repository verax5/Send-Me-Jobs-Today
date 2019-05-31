<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Mail\ContactMailable;

class ContactController extends Controller {
    public function index() {
        return view('contact');
    }

    public function send(Request $request) {
        $request->validate([
            'email' => 'email',
            'message' => 'required',
            'name' => 'required',
        ]);

        $to = 'contactus@sendmejobstoday.com';
        $from = $to;
        $userEmail = request()->input('email');
        $userMessage = request()->input('message');
        $userName = request()->input('name');

        $data = compact('to','from', 'userEmail', 'userMessage', 'userName');

        Mail::to($to)->send(new ContactMailable($data));

        return redirect()->back()->with('message', 'Your email has been received, we will contact you soon');
    }

}