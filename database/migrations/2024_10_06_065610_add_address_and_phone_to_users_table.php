<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAddressAndPhoneToUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('street_address')->nullable(false);
            $table->string('city')->nullable(false);
            $table->string('state')->nullable(false);
            $table->string('zip_code')->nullable()->default(null);
            $table->string('country')->nullable(false);
            $table->string('phone_number')->nullable(false);
            $table->date('date_of_birth')->nullable(false);
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['street_address', 'city', 'state', 'zip_code', 'country', 'phone_number', 'date_of_birth']);
        });
    }
}
