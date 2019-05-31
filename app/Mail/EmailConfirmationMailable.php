<?php namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailConfirmationMailable extends Mailable {
    use Queueable, SerializesModels;

    public $user;
    public $fromAddress = 'jobs@sendmejobstoday.com';

    public function __construct($user) {
        $this->user = $user;
    }

    public function build() {
        return $this->view('mail.email_confirmation')->from($this->fromAddress, 'Send me Jobs Today')->subject('Email Confirmation Required!');
    }
}