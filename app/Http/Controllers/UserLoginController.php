<?php namespace App\Http\Controllers;

use Hash;
use Auth;
use App\User;
use Illuminate\Http\Request;
use App\Mail\PasswordSetMailable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserLoginController extends Controller {
    public function logout() {
        Auth::logout();
        return redirect()->route('home')->with('message', 'You have been logged out');
    }

    public function directLoginIndex() {
        session(['direct_login_token' => request()->get('token')]);

        $user = User::where('direct_login_token', session('direct_login_token','direct_login_token'))->firstOrFail();

        if ($user and $user->password) {
            Auth::login($user);

            return redirect()->intended('edit-preferences');
        }

        return view('force_password_set');
    }

    public function directLoginPasswordSet() {
        $user = User::where('direct_login_token', session('direct_login_token','direct_login_token'))->firstOrFail();

        $user->password = Hash::make(request()->input('password'));
        $user->save();

        Auth::login($user);

        return redirect()->intended('edit-preferences');
    }


    public function basicLoginIndex() {
        return view('basic_login');
    }

    public function basicLogin() {
        $email = request()->input('email');
        $password = request()->input('password');

        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            return redirect()->intended('edit-preferences');
        }

        return back()->withErrors('Wrong user or pass');
    }

    public function normalPasswordSetView() {
        $token  = request()->get('token');
        User::where('direct_login_token', $token)->firstOrFail();

        return view('set_password', ['token' => $token]);
    }
    public function normalPasswordSet(Request $request) {
        $request->validate(['password' => 'required|min:6']);

        $user = User::where('direct_login_token', $request->token)->firstOrFail();
        $user->password = Hash::make($request->password);
        $user->save();

        return back()->with('message', 'Password set');
    }

    public function normalPasswordSetAskEmailView() {
        return view('set_password_ask_email');
    }
    public function normalPasswordSetAskEmailSubmit(Request $request) {
        $request->validate(['email' => 'email|required']);

        try {
            $user = User::where('email', $request->email)->firstOrFail();
        } catch (ModelNotFoundException $e) {
            Log::info($e);
            return back()->with('message', 'This email does not exist. Please register an account');
        }

        Mail::to($request->email)->send(new PasswordSetMailable($user));

        return back()->with('message', 'Password setup link has been sent to: ' . $request->email);
    }
}