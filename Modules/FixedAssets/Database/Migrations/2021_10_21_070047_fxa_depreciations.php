<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FxaDepreciations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fxa_depreciations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('vdate');
            $table->date('tdate');
            $table->boolean('is_posted_to_gl')->default(false);
            $table->unsignedBigInteger('journal_voucher_id')->nullable();
            $table->unsignedBigInteger('fxa_category_id')->nullable();
            $table->unsignedBigInteger('employee_id');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('employee_id')->references('id')->on('hr_employees');
            $table->foreign('journal_voucher_id')->references('id')->on('journal_vouchers');
            $table->foreign('fxa_category_id')->references('id')->on('fxa_categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fxa_depreciations');
    }
}
