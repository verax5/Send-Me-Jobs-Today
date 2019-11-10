<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogTable extends Migration
{
    public function up()
    {
        Schema::create('blog', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('slug');
            $table->longText('blogpost');
            $table->string('preview_text');
            $table->string('blogpost_keyword')->nullable();
            $table->string('related_jobs_keyword')->nullable();
            $table->string('location')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('blog');
    }
}
