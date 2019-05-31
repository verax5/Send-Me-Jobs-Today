<?php namespace App\Http\Controllers;

use App\User;

class UnsubController extends Controller {
    const INACTIVE_BECAUSE_USER_UNSUBBED = 3;

    public function unsub() {
        $email = request()->input('email');
        $user = User::where('email', $email)->firstOrFail();
        $user->update(['subscribed' => 0, 'status' => self::INACTIVE_BECAUSE_USER_UNSUBBED]);
        $user->jobs()->delete();

        return redirect()->route('home')->with('message', 'User unsubscribed');
    }

    public function index() {
        return view('unsub');
    }
}