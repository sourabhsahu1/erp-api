<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTreasuryVoucherSourceUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('treasury_voucher_source_units', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('long_name');
            $table->string('short_name');
            $table->unsignedBigInteger('next_pv_index_number');
            $table->unsignedBigInteger('next_rv_index_number');
            $table->string('honour_certificate');
            $table->unsignedBigInteger('checking_officer_id')->nullable();
            $table->unsignedBigInteger('paying_officer_id')->nullable();
            $table->unsignedBigInteger('financial_controller_id')->nullable();

            $table->unsignedBigInteger('retirement_id');
            $table->unsignedBigInteger('reverse_voucher_id');
            $table->unsignedBigInteger('revalidation_id');
            $table->unsignedBigInteger('tax_voucher_id');


            $table->softDeletes();
            $table->timestamps();
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
        Schema::dropIfExists('treasury_voucher_source_units');
    }
}
