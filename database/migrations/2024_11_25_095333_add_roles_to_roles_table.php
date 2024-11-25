<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;

class AddRolesToRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Insert the roles into the 'roles' table if they do not exist
        $roles = ['superadmin', 'admin', 'speaker', 'user'];

        foreach ($roles as $role) {
            if (!DB::table('roles')->where('name', $role)->exists()) {
                DB::table('roles')->insert([
                    'name' => $role,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Optionally, remove these roles when rolling back the migration
        $roles = ['superadmin', 'admin', 'speaker', 'user'];
        DB::table('roles')->whereIn('name', $roles)->delete();
    }
}
