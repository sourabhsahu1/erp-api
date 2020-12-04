<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTreasuryScheduleEconomicsAddPaymentVoucherIdPayeeIdTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('treasury_schedule_economics', function (Blueprint $table) {
            $table->unsignedBigInteger('payment_voucher_id');

            $table->foreign('payment_voucher_id')->references('id')->on('treasury_payment_vouchers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('treasury_schedule_economics', function (Blueprint $table) {
            $table->dropColumn('payment_voucher_id');
            $table->dropForeign('treasury_schedule_economics_payment_voucher_id_foreign');
        });
    }
}
