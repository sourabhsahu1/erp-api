<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminCompanyBanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_company_banks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('bank_id');
            $table->unsignedBigInteger('branch_id');
            $table->string('bank_account_number');
            $table->string('type_of_bank_account');
            $table->boolean('is_authorised')->default(1);
            $table->date('date');
            $table->foreign('company_id')->references('id')->on('admin_companies');
            $table->foreign('bank_id')->references('id')->on('hr_banks');
            $table->foreign('branch_id')->references('id')->on('hr_bank_branches');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin_company_banks');
    }
}
