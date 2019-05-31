<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobsTable extends Migration {
    public function up() {
        Schema::create('jobs', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('user_id')->reference('id')->on('users');
            $table->longText('url');
            $table->longText('title');
            $table->string('postcode')->nulable();
            $table->longText('logo')->nullable();
            $table->longText('snippet');
            $table->string('age')->nullable();
            $table->integer('age_days')->nullable();
            $table->string('location')->nullable();
            $table->string('salary')->nullable();
            $table->string('company')->nullable();
            $table->dateTime('send_on');
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('jobs');
    }
}
