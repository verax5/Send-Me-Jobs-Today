<?php namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class JobsMailable extends Mailable {
    use Queueable, SerializesModels;

    public $fromAddress = 'jobs@sendmejobstoday.com';
    public $user;
    public $jobs;

    public function __construct($user, $jobs) {
        $this->user = $user;
        $this->jobs = $jobs;
    }

    public function build() {
        $this->withSwiftMessage(function($message) {
            $message->getHeaders()->addTextHeader('List-Unsubscribe', route('unsubscribe') . '?email=' . $this->user->email);
        });

        return $this->view('mail.jobs_mail')
            ->from($this->fromAddress, 'Send me Jobs Today')
            ->subject('Todays new jobs');
    }
}