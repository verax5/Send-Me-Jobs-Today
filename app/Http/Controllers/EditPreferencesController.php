<?php namespace App\Http\Controllers;

use App\User;

class EditPreferencesController extends Controller {
    public function index() {
        return view('edit_preferences');
    }

    public function save() {
        $keyword = request()->input('keyword');
        $location = request()->input('location');

        $user = User::findOrFail(auth()->user()->id);

        $user->keyword = $keyword;
        $user->location = $location;
        $user->save();

        return back()->with('message', 'Preferences saved');
    }
}