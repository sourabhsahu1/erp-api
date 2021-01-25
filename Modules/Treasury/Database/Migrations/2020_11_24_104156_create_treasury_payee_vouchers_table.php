<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTreasuryPayeeVouchersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('treasury_payee_vouchers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('payment_voucher_id');
            $table->unsignedBigInteger('employee_id')->nullable();
            $table->unsignedBigInteger('company_id')->nullable();
            $table->decimal('net_amount',18,2);
            $table->decimal('total_tax',18,2)->nullable();
            $table->year('year');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('payment_voucher_id')->references('id')->on('treasury_payment_vouchers');
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
        Schema::dropIfExists('treasury_payee_vouchers');
    }
}
