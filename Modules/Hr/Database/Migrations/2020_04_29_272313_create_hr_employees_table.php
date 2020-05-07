<?php

use App\Constants\AppConstant;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHrEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hr_employees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('created_by_id');
            $table->unsignedBigInteger('designation_id')->nullable();
            $table->unsignedBigInteger('department_id')->nullable();
            $table->unsignedBigInteger('country_id')->nullable();
            $table->unsignedBigInteger('region_id')->nullable();
            $table->unsignedBigInteger('state_id')->nullable();
            $table->unsignedBigInteger('lga_id')->nullable();
            $table->string('personnel_file_number')->nullable();
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->string('title');
            $table->unsignedBigInteger('profile_image_id')->nullable();
            $table->string('other_names')->nullable();
            $table->string('maiden_name')->nullable();
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
            $table->date('assumed_duty')->nullable();
            $table->string('address')->nullable();
            $table->string('street')->nullable();
            $table->string('city')->nullable();
            $table->string('zip_code')->nullable();
            $table->foreign('designation_id')->references('id')->on('hr_designations');
            $table->foreign('department_id')->references('id')->on('hr_departments');
            $table->foreign('lga_id')->references('id')->on('lgas');
            $table->foreign('profile_image_id')->references('id')->on('files');
            $table->foreign('created_by_id')->references('id')->on('users');
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
        Schema::dropIfExists('hr_employees');
    }
}
