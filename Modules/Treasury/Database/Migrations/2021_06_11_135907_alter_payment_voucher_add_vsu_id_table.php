<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterPaymentVoucherAddVsuIdTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('treasury_payment_approvals', function (Blueprint $table) {
            $table->unsignedBigInteger('voucher_source_unit_id')->nullable();

            $table->foreign('voucher_source_unit_id')->references('id')->on('treasury_voucher_source_units');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('treasury_payment_approvals', function (Blueprint $table) {
            $table->dropForeign('treasury_payment_approvals_voucher_source_unit_foreign');
            $table->dropColumn('voucher_source_unit_id');
        });
    }
}
