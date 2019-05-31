<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeedJobListTable extends Seeder {
    public function run() {
        DB::table('job_list')->insert(['name' => 'Barista']);
        DB::table('job_list')->insert(['name' => 'Cleaner']);
        DB::table('job_list')->insert(['name' => 'Retail / Sales Assistant']);
        DB::table('job_list')->insert(['name' => 'Catering']);
        DB::table('job_list')->insert(['name' => 'Cleaner']);
        DB::table('job_list')->insert(['name' => 'Construction']);
        DB::table('job_list')->insert(['name' => 'Bricklayer']);
        DB::table('job_list')->insert(['name' => 'carer']);
    }
}
