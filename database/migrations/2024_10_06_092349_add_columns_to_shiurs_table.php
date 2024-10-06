<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToShiursTable extends Migration
{
    public function up()
    {
        Schema::table('shiurs', function (Blueprint $table) {
            $table->date('shiur_date')->nullable(); // Add shiur_date column
            $table->string('recording_path')->nullable(); // Change to recording_path
            // Add any additional columns you require
        });
    }

    public function down()
    {
        Schema::table('shiurs', function (Blueprint $table) {
            $table->dropColumn('shiur_date');
            $table->dropColumn('recording_path'); // Change to recording_path
            // Drop any additional columns if needed
        });
    }

}
