<?php namespace App\Http\Controllers;

use App\Classes\SearchJobs;
use Illuminate\Support\Facades\Log;
use DB;

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
        

        return view('job_details', ['jobs' => $jobs->data, 'nextPage' => $this->nextPage, 'previousPage' => $this->previousPage, 'medium' => $medium]);
    }

    public function countClick()
    {
        if(DB::table('track')->where('date', now()->toDateString())->first()) {
            DB::table('track')->where('date', now()->toDateString())->increment('count');
        } else {
            DB::table('track')->insert(['date' => now()->toDateString(), 'count' => 1]);
        }
    }

    public function getJobDetails()
    {
        return view('job_details', ['jobDetails' => $this->searchJobs->search(null, 1)->data[0]]);
    }

}
