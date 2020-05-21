<?php

use App\Constants\AppConstant;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHrTypeOfAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hr_type_of_appointments', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('type', [
                AppConstant::EMPLOYEE_TYPE_APPOINTMENT_TENURED,
                AppConstant::EMPLOYEE_TYPE_APPOINTMENT_CONTRACT,
                AppConstant::EMPLOYEE_TYPE_APPOINTMENT_ADJUNCT,
                AppConstant::EMPLOYEE_TYPE_APPOINTMENT_FULL_TIME,
                AppConstant::EMPLOYEE_TYPE_APPOINTMENT_MONTH_TO_MONTH,
                AppConstant::EMPLOYEE_TYPE_APPOINTMENT_NOT_APPLICABLE,
                AppConstant::EMPLOYEE_TYPE_APPOINTMENT_PERMANENT_STAFF,
                AppConstant::EMPLOYEE_TYPE_APPOINTMENT_SABBATICAL,
                AppConstant::EMPLOYEE_TYPE_APPOINTMENT_TEMPORARY,
                AppConstant::EMPLOYEE_TYPE_APPOINTMENT_VISITING
            ]);
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
        Schema::dropIfExists('hr_type_of_appointments');
    }
}
