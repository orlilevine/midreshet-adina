<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;

class AddSpeakersToSpeakersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Insert the speakers into the 'speakers' table if they do not exist
        $speakers = [
            [
                'salutation' => 'Mrs.',
                'first_name' => 'Shira',
                'last_name' => 'Smiles',
                'bio' => 'Shira Smiles is a renowned speaker and educator...',
                'image_path' => 'path/to/image1.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'salutation' => 'Mrs.',
                'first_name' => 'Dina',
                'last_name' => 'Schoonmaker',
                'bio' => 'Dina Schoonmaker is a popular speaker known for her inspirational talks...',
                'image_path' => 'path/to/image2.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'salutation' => 'Rabbi',
                'first_name' => 'Avi',
                'last_name' => 'Slansky',
                'bio' => 'Rabbi Avi Slansky is a respected rabbi and educator...',
                'image_path' => 'path/to/image3.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        foreach ($speakers as $speaker) {
            DB::table('speakers')->insert($speaker);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Optionally, remove these speakers when rolling back the migration
        $names = ['Shira Smiles', 'Dina Schoonmaker', 'Avi Slansky'];
        DB::table('speakers')->whereIn(DB::raw("CONCAT(first_name, ' ', last_name)"), $names)->delete();
    }
}
