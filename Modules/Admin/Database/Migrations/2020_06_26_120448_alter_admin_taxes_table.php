<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterAdminTaxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('admin_taxes', function (Blueprint $table) {
            $table->unsignedInteger('department_id')->nullable();
            $table->unsignedBigInteger('company_id')->nullable();
            $table->foreign('department_id')->references('id')->on('admin_segments');
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
        Schema::table('admin_taxes', function (Blueprint $table) {
            $table->dropColumn('department_id');
            $table->dropColumn('company_id');
        });
    }
}
