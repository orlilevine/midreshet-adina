<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // This goes here, outside the class

class AssignSuperAdminSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')
            ->where('email', 'orlilevine2@gmail.com')
            ->update(['role_id' => 1]); // Assigning superadmin role
    }
}
