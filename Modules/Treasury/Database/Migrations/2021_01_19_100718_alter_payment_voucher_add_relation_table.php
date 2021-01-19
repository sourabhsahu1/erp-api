<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterPaymentVoucherAddRelationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('treasury_payment_vouchers', function (Blueprint $table) {
            $table->foreign('payment_approve_id')->references('id')->on('treasury_payment_approvals');
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
            $table->dropForeign(    'treasury_payment_vouchers_payment_approve_id_foreign')->nullable();
        });
    }
}
