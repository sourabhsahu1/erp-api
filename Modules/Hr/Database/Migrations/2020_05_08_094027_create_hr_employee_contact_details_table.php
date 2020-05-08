<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHrEmployeeContactDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hr_employee_contact_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('employee_id');
            $table->unsignedBigInteger('country_id');
            $table->unsignedBigInteger('region_id');
            $table->unsignedBigInteger('state_id');
            $table->unsignedBigInteger('lga_id');
            $table->string('address_line_1');
            $table->string('address_line_2')->nullable();
            $table->string('city');
            $table->string('zip_code');
            $table->unsignedBigInteger('other_country_id');
            $table->unsignedBigInteger('other_region_id');
            $table->unsignedBigInteger('other_state_id');
            $table->unsignedBigInteger('other_lga_id');
            $table->foreign('country_id')->references('id')->on('lgas');
            $table->foreign('region_id')->references('id')->on('lgas');
            $table->foreign('state_id')->references('id')->on('lgas');
            $table->foreign('lga_id')->references('id')->on('lgas');

            $table->foreign('other_country_id')->references('id')->on('lgas');
            $table->foreign('other_region_id')->references('id')->on('lgas');
            $table->foreign('other_state_id')->references('id')->on('lgas');
            $table->foreign('other_lga_id')->references('id')->on('lgas');
            $table->foreign('employee_id')->references('id')->on('employees');
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
        Schema::dropIfExists('hr_employee_contact_details');
    }
}
