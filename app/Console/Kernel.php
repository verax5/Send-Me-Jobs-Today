<?php namespace App\Console;

use App\Console\Commands\CsvToDb;
use App\Console\Commands\FetchJobs;
use App\Console\Commands\JobsSender;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel {
    protected $commands = [
        FetchJobs::class,
        JobsSender::class,
        CsvToDb::class,
    ];

    protected function schedule(Schedule $schedule) {
        if(now()->tomorrow()->format('l') != 'Sunday' and now()->tomorrow()->format('l') != 'Saturday') {
            $schedule->command(FetchJobs::class)->between('1:00', '1:10');
            $schedule->command(JobsSender::class)->between('11:00', '11:10');
        }
    }

    protected function commands() {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
