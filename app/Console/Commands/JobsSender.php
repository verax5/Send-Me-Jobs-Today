<?php namespace App\Console\Commands;

use App\Queues\JobsSenderManager;
use Illuminate\Console\Command;

class JobsSender extends Command {
    protected $signature = 'SendJobs';

    protected $description = 'Start pushing jobs to queue to send';

    public function __construct() {
        parent::__construct();
    }

    public function handle() {
        JobsSenderManager::dispatch()->onQueue('command');
    }
}