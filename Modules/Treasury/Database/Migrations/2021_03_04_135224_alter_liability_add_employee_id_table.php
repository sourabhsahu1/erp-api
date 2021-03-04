<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterLiabilityAddEmployeeIdTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('treasury_retire_liabilities', function (Blueprint $table) {
            $table->unsignedBigInteger('employee_id')->nullable();
            $table->unsignedBigInteger('company_id')->nullable();
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
        Schema::table('treasury_retire_liabilities', function (Blueprint $table) {
            $table->dropForeign('treasury_retire_liabilities_employee_id_foreign');
            $table->dropForeign('treasury_retire_liabilities_employee_ids_foreign');
        });
    }
}
