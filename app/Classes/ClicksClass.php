<?php namespace App\Classes;

use App\Click;

class ClicksClass {
    private $userId;

    public function track() {
        if ($this->userId) {
            Click::updateOrCreate(['user_id' => $this->userId, 'date' => today()], ['clicks' => \DB::raw('clicks+1')]);
        }
    }

    public function setUserId($userId) {
        $this->userId = $userId;
    }

    public function trackOpens() {
        Click::updateOrCreate(['user_id' => $this->userId, 'date' => today()], ['opens' => \DB::raw('opens+1')]);
    }
}