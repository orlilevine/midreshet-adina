<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateSeriesTable2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('series', function (Blueprint $table) {
            // Add new columns
            $table->string('image_path')->nullable();
            $table->string('zoom_link')->nullable();
            $table->string('zoom_id')->nullable();
            $table->string('zoom_password')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('series', function (Blueprint $table) {

            // Drop the newly added columns
            $table->dropColumn(['image_path', 'zoom_link', 'zoom_id', 'zoom_password']);
        });
    }
}
