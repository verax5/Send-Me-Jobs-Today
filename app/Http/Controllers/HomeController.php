<?php namespace App\Http\Controllers;

use App\Classes\SearchJobs;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller {
    private $searchJobs;
    private $previousPage;
    private $nextPage;

    public function __construct(SearchJobs $searchJobs) {
        $this->searchJobs = $searchJobs;
        $this->nextPage = $this->searchJobs->getNextPage();
        $this->previousPage = $this->searchJobs->getPreviousPage();
    }

    public function index()  {
        $jobs = false;
        try {
            $jobs =  $this->searchJobs->search();
        } catch (\Exception $e) {
            Log::info($e);
        }

        return view('index', ['jobs' => $jobs, 'nextPage' => $this->nextPage, 'previousPage' => $this->previousPage]);
    }

    public function searchJobs() {
        $jobs = false;

        try {
            $jobs = $this->searchJobs->search();
        } catch (\Exception $e) {
            Log::info($e);
        }

        return view('index', ['jobs' => $jobs, 'nextPage' => $this->nextPage, 'previousPage' => $this->previousPage]);
    }

    public function privacyPolicy() {
        return view('privacy_policy');
    }

    public function jobDetails() {
        $jobs = false;

        try {
            $this->searchJobs->getJobDetails();
            $job = $this->searchJobs->search();
        } catch (\Exception $e) {
            Log::info($e);
        }

        return view('job_details', ['job' => $job->data[0], 'nextPage' => $this->nextPage, 'previousPage' => $this->previousPage]);
    }

}
