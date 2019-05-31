<?php namespace App\Http\Controllers;

use Mail;
use App\User;
use App\Mail\EmailConfirmationMailable;

class EmailConfirmController extends Controller {
    public function confirm($token) {
        $user = User::where('confirmation_token', $token)->firstOrFail();
        $user->update(['confirmation_token' => '']);

        return redirect()->route('home')->with('message', 'Your email has been confirmed and you will start receiving jobs soon');
    }

    public function sendReconfirmation() {
        $confirmationToken = md5(uniqid(auth()->user()->email, true));
        User::where('id', auth()->user()->id)->update(['confirmation_token' => $confirmationToken]);

        $user = User::find(auth()->user()->id);

        Mail::to($user->email)->send(new EmailConfirmationMailable($user));

        return back()->with('message', 'Confirmation email has been sent');
    }
}