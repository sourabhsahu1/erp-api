<?php

use App\Constants\AppConstant;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTreasuryPaymentVouchersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('treasury_payment_vouchers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('voucher_source_unit_id');
            $table->string('source_unit');
            $table->unsignedBigInteger('deptal_id');
            $table->unsignedBigInteger('voucher_number')->nullable();
            $table->date('value_date');
            $table->unsignedBigInteger('payment_approve_id')->nullable();
            $table->enum('payee', [
                AppConstant::PAYEE_CUSTOMER,
                AppConstant::PAYEE_EMPLOYEE
            ]);
            $table->enum('type',[
                AppConstant::VOUCHER_TYPE_DEPOSIT_VOUCHER,
                AppConstant::VOUCHER_TYPE_EXPENDITURE_CREDIT_VOUCHER,
                AppConstant::VOUCHER_TYPE_EXPENDITURE_VOUCHER,
                AppConstant::VOUCHER_TYPE_NON_PERSONAL_VOUCHER,
                AppConstant::VOUCHER_TYPE_PERSONAL_ADVANCES_VOUCHER,
                AppConstant::VOUCHER_TYPE_REMITTANCE_VOUCHER,
                AppConstant::VOUCHER_TYPE_SPECIAL_VOUCHER,
                AppConstant::VOUCHER_TYPE_STANDING_VOUCHER,
                AppConstant::VOUCHER_TYPE_TRANSFER_CASHBOOK_VOUCHER
            ]);
            $table->enum('status',[
                AppConstant::VOUCHER_STATUS_CHECKED,
                AppConstant::VOUCHER_STATUS_DRAFT,
                AppConstant::VOUCHER_STATUS_APPROVED,
                AppConstant::VOUCHER_STATUS_AUDITED,
                AppConstant::VOUCHER_STATUS_BUDGET_CONTROL_VERIFIED,
                AppConstant::VOUCHER_STATUS_CLOSED,
                AppConstant::VOUCHER_STATUS_NEW,
                AppConstant::VOUCHER_STATUS_ON_MANDATE,
                AppConstant::VOUCHER_STATUS_PAID,
                AppConstant::VOUCHER_STATUS_POSTED_TO_GL
            ]);
            $table->boolean('is_payment_approval')->default(0);
            $table->unsignedBigInteger('currency_id');
            $table->string('payment_description');
            $table->decimal('x_rate', 12, 2);
            $table->decimal('official_x_rate', 12, 2);
            $table->unsignedBigInteger('aie_id');
            $table->unsignedInteger('admin_segment_id');
            $table->unsignedInteger('fund_segment_id');
            $table->unsignedInteger('economic_segment_id')->nullable();
            $table->unsignedInteger('program_segment_id')->nullable();
            $table->unsignedInteger('functional_segment_id')->nullable();
            $table->unsignedInteger('geo_code_segment_id')->nullable();

            $table->unsignedBigInteger('checking_officer_id')->nullable();
            $table->unsignedBigInteger('paying_officer_id')->nullable();
            $table->unsignedBigInteger('financial_controller_id')->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('voucher_source_unit_id')->references('id')->on('treasury_voucher_source_units');
            $table->foreign('currency_id')->references('id')->on('currencies');
            $table->foreign('aie_id')->references('id')->on('treasury_aies');
            $table->foreign('admin_segment_id')->references('id')->on('admin_segments');
            $table->foreign('fund_segment_id')->references('id')->on('admin_segments');
            $table->foreign('economic_segment_id')->references('id')->on('admin_segments');
            $table->foreign('program_segment_id')->references('id')->on('admin_segments');
            $table->foreign('functional_segment_id')->references('id')->on('admin_segments');
            $table->foreign('geo_code_segment_id')->references('id')->on('admin_segments');
            $table->foreign('checking_officer_id')->references('id')->on('hr_employees');
            $table->foreign('paying_officer_id')->references('id')->on('hr_employees');
            $table->foreign('financial_controller_id')->references('id')->on('hr_employees');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('treasury_payment_vouchers');
    }
}
