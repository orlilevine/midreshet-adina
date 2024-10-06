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
        Schema::table('series', function (Blueprint $table) {
            $table->decimal('price', 8, 2)->after('description')->nullable();
        });
    }

    public function down()
    {
        Schema::table('series', function (Blueprint $table) {
            $table->dropColumn('price');
        });
    }

};
