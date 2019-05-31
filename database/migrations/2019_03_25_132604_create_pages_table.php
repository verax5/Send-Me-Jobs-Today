<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagesTable extends Migration {
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug');
            $table->string('keyword');
            $table->string('page_title');
            $table->longtext('page_main_heading');
            $table->longtext('page_subheading');
            $table->string('body_title');
            $table->longText('page_body');
            $table->string('page_under_body');
            $table->string('form_title');
            $table->string('image');
            $table->longText('styles');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pages');
    }
}
