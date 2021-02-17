<?php

use App\Constants\AppConstant;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTreasuryReceiptVouchersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('treasury_receipt_vouchers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('voucher_source_unit_id');
            $table->string('source_department');
            $table->unsignedBigInteger('deptal_id');
            $table->unsignedBigInteger('voucher_number')->nullable();
            $table->date('value_date');
            $table->decimal('receipt_number',10,2)->nullable();
            $table->enum('payee', [
                AppConstant::PAYEE_CUSTOMER,
                AppConstant::PAYEE_EMPLOYEE
            ]);
            $table->enum('type',[
                AppConstant::VOUCHER_TYPE_REVENUE_VOUCHER,
                AppConstant::VOUCHER_TYPE_NON_PERSONAL_ADVANCES_RECEIVED_VOUCHER,
                AppConstant::VOUCHER_TYPE_SPECIAL_IMPREST_RECEIVED_VOUCHER,
                AppConstant::VOUCHER_TYPE_STANDING_IMPREST_RECEIVED_VOUCHER,
                AppConstant::VOUCHER_TYPE_REMITTANCE_RECEIVED_VOUCHER,
                AppConstant::VOUCHER_TYPE_DEPOSIT_RECEIVED_VOUCHER,
                AppConstant::VOUCHER_TYPE_REVENUE_DEBIT_VOUCHER
            ]);
            $table->enum('status',[
                AppConstant::RECEIPT_VOUCHER_STATUS_NEW,
                AppConstant::RECEIPT_VOUCHER_STATUS_CLOSED,
                AppConstant::RECEIPT_VOUCHER_STATUS_POSTED_TO_GL
            ]);
//            $table->unsignedBigInteger('currency_id');
            $table->string('payment_description');
            $table->decimal('x_rate', 12, 2);
            $table->decimal('official_x_rate', 12, 2);
            $table->unsignedInteger('admin_segment_id');
            $table->unsignedInteger('fund_segment_id');
            $table->unsignedInteger('economic_segment_id')->nullable();
            $table->unsignedInteger('program_segment_id')->nullable();
            $table->unsignedInteger('functional_segment_id')->nullable();
            $table->unsignedInteger('geo_code_segment_id')->nullable();

            $table->unsignedBigInteger('receiving_officer_id');
            $table->unsignedBigInteger('prepared_by_officer_id')->nullable();
            $table->unsignedBigInteger('closed_by_officer_id')->nullable();
            $table->unsignedBigInteger('cashbook_id');

            $table->softDeletes();
            $table->timestamps();
            $table->foreign('voucher_source_unit_id')->references('id')->on('treasury_voucher_source_units');
//            $table->foreign('currency_id')->references('id')->on('currencies');
            $table->foreign('admin_segment_id')->references('id')->on('admin_segments');
            $table->foreign('fund_segment_id')->references('id')->on('admin_segments');
            $table->foreign('economic_segment_id')->references('id')->on('admin_segments');
            $table->foreign('program_segment_id')->references('id')->on('admin_segments');
            $table->foreign('functional_segment_id')->references('id')->on('admin_segments');
            $table->foreign('geo_code_segment_id')->references('id')->on('admin_segments');
            $table->foreign('receiving_officer_id')->references('id')->on('hr_employees');
            $table->foreign('prepared_by_officer_id')->references('id')->on('hr_employees');
            $table->foreign('closed_by_officer_id')->references('id')->on('hr_employees');
            $table->foreign('cashbook_id')->references('id')->on('treasury_cashbooks');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('treasury_receipt_vouchers');
    }
}
