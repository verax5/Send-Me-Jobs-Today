<?php namespace App\Http\Controllers;

use Hash;
use Mail;
use App\User;
use App\JobList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class CreateJobAlertController extends Controller {
    private $name, $keyword, $location, $email, $confirmationToken, $directLoginToken;

    public function __construct() {
        $this->name = request()->input('name');
        $this->location = request()->input('location');
        $this->email = request()->input('email');
        $this->confirmationToken = md5(uniqid($this->email, true));
        $this->directLoginToken = md5(uniqid($this->email, true));
    }

    public function index() {
        return view('create_alert', ['jobList' => JobList::all()]);
    }

    public function create(Request $request) {
        $validator = Validator::make($request->all(), [
            'location' => 'required', 'email' => 'email|unique:users,email'], ['location.required' => 'Write area you want to work in..'] );

        if (! $request->keyword and $request->custom_keyword) {
            $validator->getMessageBag()->merge(['keyword' => 'Please choose or write what job you want to do']);
        }

        if($validator->fails()) {
            return back()->withErrors($validator);
        }

        if($request->custom_keyword) {
            $keyword = $request->custom_keyword;
        } else {
            $keyword = $request->keyword;
        }

        User::updateOrCreate(['email' => $this->email], [
                'name' => $this->name,
                'keyword' => $keyword,
                'location' => $this->location,
                'confirmation_token' => '',
                'signup_type' => 'site',
                'last_jobs_fetch_attempt' => now()->subDay()->toDateTimeString(),
                'direct_login_token' => $this->directLoginToken,
                'subscribed' => 1,
                'status' => 1,
            ]
        );

        Session::flash('keyword', $this->keyword ? $this->keyword : $keyword);
        Session::flash('location', $this->location);
        return redirect()->back()->with('signed_up', 'You will start receiving alerts about job!');
    }
}