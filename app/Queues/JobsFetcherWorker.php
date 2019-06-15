<?php namespace App\Queues;

use App\User;
use App\Setting;
use GuzzleHttp\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class JobsFetcherWorker implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $api = 'https://adview.online/api/v1/jobs.json';
    private $publisher = 1145;
    private $user;

    private $guzzle;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function handle(Client $guzzle)
    {
        $this->cacheSettings();

        $this->guzzle = $guzzle;
        $user = User::find($this->user->id);

        try {
            $retry = false;
            $jobs = $this->fetch($this->user, $retry);

            if ($jobs) {
                $this->storeJobs($jobs);
            } elseif (Cache::get('dropLocation') == 1) {
                $retry = true;
                $jobs = $this->fetch($this->user, $retry);
                $this->storeJobs($jobs);
            }

            $user->last_jobs_fetch_attempt = now();
            $user->save();

        } catch (\Exception $e) {
            $user->last_jobs_fetch_attempt = now()->toDateTimeString();
            $user->save();

            Log::info($e);
        }
    }

    private function fetch($user, $retry)
    {
        $location = $user->location;
        $limit = 10;

        if ($retry) {
            $location = '';
        }

        if (Cache::get('singleFetch') == 1) {
            $limit = 1;
        }

        $request = $this->guzzle->request('GET', $this->api, [
                'query' => [
                    'publisher' => $this->publisher,
                    'keyword' => $user->keyword,
                    'location' => $location,
                    'unique_id' => $user->email,
                    'limit' => $limit,
                    'radius' => 10,
                ]
            ]
        );

        return json_decode($request->getBody()->getContents())->data;
    }

    private function storeJobs($jobs)
    {
        foreach ($jobs as $job) {
            $user = User::find($this->user->id);

            $job = [
                'url' => $job->url,
                'title' => $job->title,
                'postcode' => $job->postcode,
                'logo' => $job->logo,
                'snippet' => $job->snippet,
                'age' => $job->age,
                'age_days' => $job->age_days,
                'location' => $job->location,
                'salary' => $job->salary,
                'company' => $job->company,
                'send_on' => now()->addDay()
            ];

            $user->jobs()->create($job);
        }
    }

    // Caches for 10 mins. New values will be used after that.
    private function cacheSettings()
    {
        $settings = Setting::all();

        if (!Cache::get('dropLocation')) {
            $setting = (int)$settings->where('name', 'drop_location')->first()->value;
            Cache::put('dropLocation', $setting, 10);
        }

        if (!Cache::get('singleFetch')) {
            $setting = (int)$settings->where('name', 'single_fetch')->first()->value;
            Cache::put('singleFetch', $setting, 10);
        }
    }
}