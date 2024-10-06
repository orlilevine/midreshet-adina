<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePurchasesTableForeignKey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Drop the existing foreign key constraint
        Schema::table('purchases', function (Blueprint $table) {
            $table->dropForeign(['user_id']); // Drop the foreign key constraint
        });

        // Add a new foreign key constraint referencing the users table
        Schema::table('purchases', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); // Add new constraint
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Drop the foreign key constraint for rollback
        Schema::table('purchases', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });

        // Re-add the foreign key constraint referencing the users_archive table
        Schema::table('purchases', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users_archive')->onDelete('cascade'); // Re-add the old constraint if rolling back
        });
    }
}
