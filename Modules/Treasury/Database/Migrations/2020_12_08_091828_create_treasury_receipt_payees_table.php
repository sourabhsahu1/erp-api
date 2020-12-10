<?php

use App\Constants\AppConstant;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTreasuryReceiptPayeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('treasury_receipt_payees', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('receipt_voucher_id');
            $table->unsignedBigInteger('employee_id')->nullable();
            $table->unsignedBigInteger('company_id')->nullable();
            $table->decimal('total_amount',18,2);
            $table->year('year');
            $table->string('details');
            $table->enum('pay_mode', [
                AppConstant::RECEIPT_PAY_MODE_CASH,
                AppConstant::RECEIPT_PAY_MODE_DIRECT_PAYMENTS,
                AppConstant::RECEIPT_PAY_MODE_INSTRUMENTS

            ]);
            $table->string('instrument_number');
            $table->string('instrument_type');
            $table->string('instrument_teller_number');
            $table->string('instrument_issued_by');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('receipt_voucher_id')->references('id')->on('treasury_receipt_vouchers');
            $table->foreign('employee_id')->references('id')->on('hr_employees');
            $table->foreign('company_id')->references('id')->on('admin_companies');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('treasury_receipt_payees');
    }
}
