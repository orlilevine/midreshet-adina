<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveIsPartOfPlaylistAndZoomLinkFromShiursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('shiurs', function (Blueprint $table) {
            // Drop the columns
            $table->dropColumn(['is_part_of_playlist', 'zoom_link']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('shiurs', function (Blueprint $table) {
            // Add the columns back if the migration is rolled back
            $table->tinyInteger('is_part_of_playlist')->default(0);
            $table->string('zoom_link')->nullable();
        });
    }
}
