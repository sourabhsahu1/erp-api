<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTreasuryPaymentVoucherAddMandateIdTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('treasury_payment_vouchers', function (Blueprint $table) {
            $table->unsignedBigInteger('mandate_id')->after('voucher_source_unit_id')->nullable();

            $table->foreign('mandate_id')->references('id')->on('treasury_mandates');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('treasury_payment_vouchers', function (Blueprint $table) {
            $table->dropForeign('treasury_payment_vouchers_mandate_id_foreign');
            $table->dropColumn('mandate_id');
        });
    }
}
