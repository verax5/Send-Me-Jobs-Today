<?php namespace App\Console\Commands;

use App\Queues\JobsFetcherManager;
use Illuminate\Console\Command;

class FetchJobs extends Command {
    protected $signature = 'FetchJobs';

    protected $description = 'Start sending jobs';

    public function __construct() {
        parent::__construct();
    }

    public function handle() {
        JobsFetcherManager::dispatch()->onQueue('command');
    }
}