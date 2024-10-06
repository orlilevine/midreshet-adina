<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('homepage_slides', function (Blueprint $table) {
            $table->id();
            $table->string('image_path');
            $table->string('title')->nullable(); // Optional title for the slide
            $table->string('subtitle')->nullable(); // Optional subtitle
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('homepage_slides');
    }

};
