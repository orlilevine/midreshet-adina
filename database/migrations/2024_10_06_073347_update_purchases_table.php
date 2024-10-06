<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('purchases', function (Blueprint $table) {
            // Adding series_id column to reference series purchases
            $table->unsignedBigInteger('series_id')->nullable()->after('user_id');
            $table->foreign('series_id')->references('id')->on('series')->onDelete('cascade');

            // Add coupon fields for discount handling
            $table->boolean('coupon')->default(0)->after('amount'); // if coupon was used
            $table->string('coupon_code')->nullable()->after('coupon');

            // Add payment method fields for alternative payment options
            $table->string('payment_method')->default('cc')->after('coupon_code'); // default to credit card
            $table->string('zelle_account_from')->nullable()->after('payment_method');
            $table->decimal('zelle_amount', 8, 2)->nullable()->after('zelle_account_from');
            $table->date('zelle_date')->nullable()->after('zelle_amount');
            $table->string('check_name')->nullable()->after('zelle_date');
            $table->decimal('check_amount', 8, 2)->nullable()->after('check_name');
            $table->date('check_date')->nullable()->after('check_amount');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('purchases', function (Blueprint $table) {
            // Drop the new columns in case of rollback
            $table->dropForeign(['series_id']);
            $table->dropColumn([
                'series_id',
                'coupon',
                'coupon_code',
                'payment_method',
                'zelle_account_from',
                'zelle_amount',
                'zelle_date',
                'check_name',
                'check_amount',
                'check_date',
            ]);
        });
    }
}
