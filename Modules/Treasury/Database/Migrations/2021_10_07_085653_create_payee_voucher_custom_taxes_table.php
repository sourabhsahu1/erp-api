<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePayeeVoucherCustomTaxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payee_voucher_custom_taxes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('payee_voucher_id');
            $table->unsignedBigInteger('tax_id');
            $table->unsignedDecimal('tax_percentage',12,2);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('payee_voucher_id')->references('id')->on('treasury_payee_vouchers');
            $table->foreign('tax_id')->references('id')->on('admin_taxes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payee_voucher_custom_taxes');
    }
}
