<?php namespace App\Queues;

use App\Setting;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\DB;

class JobsSenderManager implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $timeout = 1800;

    public function handle()
    {
        $chunk = 5000;
        $singleFetch = Setting::where('name', 'single_fetch')->first()->value;

        DB::table('users')->where('subscribed', 1)->where('status', 1)
            ->where(function ($query) {
                $query->where('confirmation_token', '')->orWhereNull('confirmation_token');
            })->chunkById($chunk, function ($users) use ($singleFetch) {
                foreach ($users as $userCollection) {
                    $userModel = User::find($userCollection->id);
                    JobsSenderWorker::dispatch($userModel, $singleFetch)->onQueue('sender');
                }
            });
    }
}