<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes\SearchJobs;

class BlogController extends Controller
{
	private $searchJobs;

	public function __construct(SearchJobs $searchJobs) {
		$this->searchJobs = $searchJobs;
	}

    public function index()
    {
    	$jobs = false;
        
        try {
            $jobs =  $this->searchJobs->search();
        } catch (\Exception $e) {
            Log::info($e);
        }

    	$blogposts = \DB::table('blog')->orderBy('id', 'desc')->get();
    	return view('blog_index', ['blogposts' => $blogposts, 'jobs' => $jobs]);
    }

    public function blogPost($slug) {
    	$blogpost = \DB::table('blog')->where('slug', trim($slug))->first();
    	$jobs = false;

        try {
        	$this->searchJobs->blogpostKeyword = $blogpost->related_jobs_keyword;
        	$this->searchJobs->blogpostLocation = $blogpost->location;

            $jobs =  $this->searchJobs->search('blog');
        } catch (\Exception $e) {
            \Log::info($e);
        }

    	return view('blogpost', ['blogpost' => $blogpost, 'jobs' => $jobs]);
    }
}