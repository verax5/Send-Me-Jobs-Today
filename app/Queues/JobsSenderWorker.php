<?php namespace App\Queues;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Mail\JobsMailable;
use Illuminate\Support\Facades\Log;

class JobsSenderWorker implements ShouldQueue {
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $user;

    public function __construct($userModel) {
        $this->user = $userModel;
    }

    public function handle() {
        sleep(config('app.email_sender_delay'));

        $jobsCollection = $this->user->jobs()->whereDate('send_on', '<=', today())->get();

        if (count($jobsCollection) > 0) {
            try {
                \Mail::to($this->user->email)->send(new JobsMailable($this->user, $jobsCollection));
            } catch (\Exception $e) {
                Log::info($e);
            }

            $this->user->jobs()->whereDate('send_on', '<=', today())->delete();
        }
    }
}