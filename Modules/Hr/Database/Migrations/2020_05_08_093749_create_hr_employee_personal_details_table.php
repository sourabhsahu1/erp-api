<?php

use App\Constants\AppConstant;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHrEmployeePersonalDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hr_employee_personal_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('employee_id');
            $table->date('date_of_birth');
            $table->enum('marital_status', [
                AppConstant::EMPLOYEE_MARITAL_STATUS_SINGLE,
                AppConstant::EMPLOYEE_MARITAL_STATUS_MARRIED,
                AppConstant::EMPLOYEE_MARITAL_STATUS_DIVORCED,
                AppConstant::EMPLOYEE_MARITAL_STATUS_WIDOWED,
                AppConstant::EMPLOYEE_MARITAL_STATUS_OTHER
            ]);

            $table->enum('gender', [
                AppConstant::EMPLOYEE_GENDER_MALE,
                AppConstant::EMPLOYEE_GENDER_FEMALE
            ]);

            $table->enum('religion', [
                AppConstant::EMPLOYEE_RELIGION_CHRISTIANITY,
                AppConstant::EMPLOYEE_RELIGION_ISLAM,
                AppConstant::EMPLOYEE_RELIGION_OTHER
            ]);
            $table->string('phone');
            $table->string('email');
            $table->boolean('is_permanent_staff')->nullable();
            $table->enum('type_of_appointment', [
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
            $table->date('appointed_on')->nullable();
            $table->date('assumed_duty_on')->nullable();
            $table->foreign('employee_id')->references('id')->on('hr_employees');
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
        Schema::dropIfExists('hr_employee_personal_details');
    }
}
