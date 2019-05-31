<?php namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMailable extends Mailable {
    use Queueable, SerializesModels;
    public $data;

    public function __construct($data) {
        $this->data = $data;
    }

    public function build() {
        return $this->view('mail.contact')
            ->replyTo($this->data['userEmail'])
            ->subject('User has contacted you..')
            ->from($this->data['from'], 'Send me Jobs Today');
    }
}