<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakePostcodeNullableInJobsTable extends Migration {
    public function up() {
        Schema::table('jobs', function (Blueprint $table) {
            $table->string('postcode')->nullable()->change();
        });
    }

    public function down() {
        Schema::table('jobs', function (Blueprint $table) {
            //
        });
    }
}
