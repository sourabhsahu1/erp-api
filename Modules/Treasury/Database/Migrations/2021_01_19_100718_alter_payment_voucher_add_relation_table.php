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
            $table->unsignedBigInteger('cashbook_id')->nullable();
            $table->boolean('is_previous_year_advance')->default(0);
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
//            $table->dropColumn('is_previous_year_advance');
            $table->dropForeign(    'treasury_payment_vouchers_payment_approve_id_foreign');
//            $table->foreign('cashbook_id')->references('id')->on('treasury_cashbooks');
        });
    }
}
