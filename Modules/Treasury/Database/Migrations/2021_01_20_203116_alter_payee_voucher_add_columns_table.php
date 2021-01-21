<?php

use App\Constants\AppConstant;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterPayeeVoucherAddColumnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('treasury_payee_vouchers', function (Blueprint $table) {
            $table->enum('pay_mode', [
                AppConstant::RECEIPT_PAY_MODE_CASH,
                AppConstant::RECEIPT_PAY_MODE_DIRECT_PAYMENTS,
                AppConstant::RECEIPT_PAY_MODE_INSTRUMENTS

            ])->nullable();
            $table->string('instrument_number')->nullable();
            $table->string('instrument_type')->nullable();
            $table->string('instrument_teller_number')->nullable();
            $table->string('instrument_issued_by')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('treasury_payee_vouchers', function (Blueprint $table) {
            $table->dropColumn('pay_mode');
            $table->dropColumn('instrument_number');
            $table->dropColumn('instrument_type');
            $table->dropColumn('instrument_teller_number');
            $table->dropColumn('instrument_issued_by');
        });
    }
}
