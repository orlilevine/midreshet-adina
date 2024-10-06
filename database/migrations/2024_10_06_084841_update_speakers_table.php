<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateSpeakersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('speakers', function (Blueprint $table) {
            $table->string('salutation')->nullable()->after('id');
            $table->string('first_name')->after('salutation');
            $table->string('last_name')->after('first_name');
            $table->string('image_path')->nullable()->after('bio');

            // Drop the name column
            $table->dropColumn('name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('speakers', function (Blueprint $table) {
            // Add the name column back
            $table->string('name')->after('id');

            // Drop the new columns
            $table->dropColumn('salutation');
            $table->dropColumn('first_name');
            $table->dropColumn('last_name');
            $table->dropColumn('image_path');
        });
    }
}
