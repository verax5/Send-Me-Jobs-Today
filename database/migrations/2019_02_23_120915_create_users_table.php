<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {
    public function up() {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('keyword');
            $table->string('location');
            $table->string('email')->unique();
            $table->string('confirmation_token')->nullable();
            $table->string('direct_login_token')->nullable();
            $table->string('password')->nullable();
            $table->string('remember_token')->nullable();
            $table->boolean('subscribed')->default(1);
            $table->string('status')->default(1);
            $table->dateTime('last_jobs_fetch_attempt');
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('users');
    }
}