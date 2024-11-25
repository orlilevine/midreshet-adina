<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToSeriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('series', function (Blueprint $table) {
            // Adding new fields to the series table
            $table->string('title')->nullable(false)->change(); // Make sure title is not nullable
            $table->text('description')->nullable()->change();
            $table->decimal('price', 8, 2)->nullable()->change();
            $table->bigInteger('speaker_id')->unsigned()->nullable(false)->change(); // Assuming speaker_id is a foreign key, so keeping it required
            $table->string('image_path')->nullable()->change();
            $table->string('zoom_link')->nullable()->change();
            $table->string('zoom_id')->nullable()->change();
            $table->string('zoom_password')->nullable()->change();
            $table->boolean('is_featured')->default(0)->change(); // Ensuring this is a boolean and has a default of 0
            $table->timestamp('starting_time')->nullable()->after('is_featured'); // New column for starting time

            // Add additional fields for multiple shiur dates
            $table->date('shiur_date_1')->nullable()->after('starting_time');
            $table->date('shiur_date_2')->nullable()->after('shiur_date_1');
            $table->date('shiur_date_3')->nullable()->after('shiur_date_2');
            $table->date('shiur_date_4')->nullable()->after('shiur_date_3');
            $table->date('shiur_date_5')->nullable()->after('shiur_date_4');
            $table->date('shiur_date_6')->nullable()->after('shiur_date_5');
            $table->date('shiur_date_7')->nullable()->after('shiur_date_6');
            $table->date('shiur_date_8')->nullable()->after('shiur_date_7');
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
            // Remove the added columns if rolling back the migration
            $table->dropColumn([
                'starting_time',
                'shiur_date_1',
                'shiur_date_2',
                'shiur_date_3',
                'shiur_date_4',
                'shiur_date_5',
                'shiur_date_6',
                'shiur_date_7',
                'shiur_date_8',
            ]);
        });
    }
}
