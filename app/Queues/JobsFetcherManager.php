<?php namespace App\Queues;

use DB;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class JobsFetcherManager implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle()
    {
        DB::table('users')->where('subscribed', 1)->where('status', 1)
            ->where(function ($query) {
                $query->where(['confirmation_token' => ''])->orWhereNull('confirmation_token');
            })
            ->whereDate('last_jobs_fetch_attempt', '<', today())
            ->where('status', 1)
            ->chunkById(5000, function ($users) {
                foreach ($users as $user) {
                    JobsFetcherWorker::dispatch($user)->onQueue('fetcher');
                }

                sleep(20);
            });
    }
}