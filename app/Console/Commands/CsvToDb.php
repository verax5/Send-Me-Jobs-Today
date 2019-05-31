<?php namespace App\Console\Commands;

use App\Classes\CsvToDbClass;
use Illuminate\Console\Command;

class CsvToDb extends Command {

    /** @var CsvToDbClass */
    private $csvToDbClass;
    protected $signature = 'CsvToDb {--filename=} {--lines=0}';

    protected $description = 'Read data form csv file and upload to database';

    public function __construct(CsvToDbClass $csvToDbClass) {
        parent::__construct();
        $this->csvToDbClass = $csvToDbClass;
    }

    public function handle() {
        $this->csvToDbClass->setFileName($this->option('filename'));
        $this->csvToDbClass->setLinesToInsert($this->option('lines'));
        $this->csvToDbClass->proceed();
    }
}
