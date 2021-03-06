<?php namespace App\Classes;

use App\User;
use GuzzleHttp\Client;

class SearchJobs
{
    private $guzzle;
    private $keyword;
    private $location;
    private $category;
    private $api = 'https://adview.online/api/v1/jobs.json';
    private $publisher = 2574;
    private $mode = 'advanced';

    private $currentPage;
    private $nextPage;
    private $previousPage;
    private $jobDetailsSearch = false;

    public $blogpostKeyword;
    public $blogpostLocation;
    
    public function __construct(Client $guzzle)
    {
        $this->guzzle = $guzzle;

        $this->keyword = request()->input('keyword') == false ? 'bricklayer' : request()->input('keyword');
        $this->location = request()->input('location') == false ? 'london' : request()->input('location');

        $this->category = request()->input('category');

        $this->setCurrentPage(request()->input('page'));
    }

    public function setCurrentPage($page)
    {
        $this->currentPage = $page;

        if ($this->currentPage == '') {
            $this->currentPage = 1;
        }

        $this->nextPage = $this->currentPage + 1;
        $this->previousPage = ($this->currentPage - 1) <= 0 ? 1 : $this->currentPage - 1;
    }

    public function search($page = null, $limit=50)
    {
        $uniqueId = '';

        if($page == 'blog') {
            $this->keyword = $this->blogpostKeyword;
            $this->location = $this->blogpostLocation;
        } else {
            $this->keyword = str_replace(['/', '–', '-'], ' ', request()->get('keyword'));
            $this->location = request()->get('location');
        }

        if (app()->environment() == 'local') {
            $userIp = request()->getClientIp();
        }

        if (app()->environment() == 'live') {
            $userIp = $_SERVER['HTTP_CF_CONNECTING_IP'];
        }

        if($this->mode == 'advanced') {
            $this->keyword =  '@(title) ' . $this->keyword;
        }

        $snippet = 'basic';
        if(request()->route()->uri == 'job-apply') {
            $snippet = 'full';
        }

        $query = [
            'publisher' => $this->publisher,
            'page' => $this->currentPage,
            'keyword' => $this->keyword,
            'location' => $this->location,
            'categories' => $this->category,
            'user_agent' => request()->server('HTTP_USER_AGENT'),
            'user_ip' => $userIp,
            // Give me any job even without salary 'salary_from' => 1,
            'limit' => $limit,
            'radius' => 20,
            'mode' => $this->mode,
            'snippet' => $snippet
        ];


        $request = $this->guzzle->request('GET', $this->api, [
            'query' => http_build_query($query),
            ]
        );

        return json_decode($request->getBody()->getContents());
    }

    public function getNextPage()
    {
        return $this->nextPage;
    }

    public function getPreviousPage()
    {
        return $this->previousPage;
    }

    public function getJobDetails($title = null)
    {
        return view('job_details', ['jobDetails'=>$this->search(null, 1)]);
    }
}