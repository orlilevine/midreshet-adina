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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();

            // Change role_id to be nullable, but it can also default to user role
            $table->unsignedBigInteger('role_id')->nullable();
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');

            $table->string('first_name');
            $table->string('last_name');
            $table->string('street_address');
            $table->string('city');
            $table->string('state');
            $table->string('zip_code')->nullable(); // Made nullable for flexibility
            $table->string('country');
            $table->string('phone_number');
            $table->date('date_of_birth');
        });
    }


    public function down()
    {
        Schema::dropIfExists('users');
    }

};
