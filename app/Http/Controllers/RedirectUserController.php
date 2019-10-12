<?php namespace App\Http\Controllers;

use App\Classes\ClicksClass;
use App\Click;

class RedirectUserController extends Controller {

    /** @var ClicksClass */
    private $clicksClass;

    public function __construct(ClicksClass $clicksClass) {
        $this->clicksClass = $clicksClass;
    }

    public function redirect() {
        $this->clicksClass->setUserId(request()->input('user_id'));
        $this->clicksClass->track();

        $redirectTo = 'https://adview.online' . urldecode(request()->input('url'));

        return view('redirect_page', ['redirectTo' => $redirectTo]);
    }

    public function trackOpens($userId) {
        $this->clicksClass->setUserId($userId);
        $this->clicksClass->trackOpens();
    }

}