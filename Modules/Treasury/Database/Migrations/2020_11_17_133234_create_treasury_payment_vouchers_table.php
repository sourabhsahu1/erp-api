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
            $table->unsignedBigInteger('deptal_id')->nullable();
            $table->unsignedBigInteger('voucher_number');
            $table->date('value_date');
            $table->unsignedBigInteger('payment_approve_id')->nullable();
            $table->enum('payee', [
                AppConstant::PAYEE_CUSTOMER,
                AppConstant::PAYEE_EMPLOYEE
            ]);
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
