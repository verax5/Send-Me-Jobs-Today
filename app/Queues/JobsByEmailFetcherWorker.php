<?php namespace App\Queues;

use App\User;
use GuzzleHttp\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;

class JobsByEmailFetcherWorker implements ShouldQueue {
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $api = 'https://adview.online/api/v1/jobs.json';
    private $publisher = 1145;
    private $user;

    private $guzzle;

    public function __construct($user) {
        $this->user = $user;
    }

    public function handle(Client $guzzle) {
        $this->guzzle = $guzzle;

        echo $this->user->id;
        $user = User::find($this->user->id);

        try {
            $retry = false;
            $jobs = $this->fetch($this->user, $retry);

            if ($jobs) {
                $this->storeJobs($jobs);
            } else {
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

    private function fetch($user, $retry) {
        $location = $user->location;
        $keyword = $user->keyword;

        if ($retry) {
            $location = '';
            $keyword = '';
        }

        $request = $this->guzzle->request('GET', $this->api, [
                'query' => [
                    'publisher' => $this->publisher,
                    'keyword' => $keyword,
                    'location' => $location,
                    'unique_id' => $user->email,
                    'limit' => 25,
                    'radius' => 10,
                ]
            ]
        );

        return json_decode($request->getBody()->getContents())->data;
    }

    private function storeJobs($jobs) {
        foreach($jobs as $job) {
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
}
