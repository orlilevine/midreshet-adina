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
        if (Schema::hasTable('shiurim')) {
            Schema::rename('shiurim', 'shiurs');
        }
    }

    public function down()
    {
        Schema::rename('shiurs', 'shiurs');
    }
};
