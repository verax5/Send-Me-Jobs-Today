<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOpensColumnToClicksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clicks', function (Blueprint $table) {
            if (! Schema::hasColumn('clicks', 'opens')) {
                $table->addColumn('integer', 'opens');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('clicks', function (Blueprint $table) {
            if (Schema::hasColumn('clicks', 'opens')) {
                $table->dropColumn('opens');
            }
        });
    }
}
