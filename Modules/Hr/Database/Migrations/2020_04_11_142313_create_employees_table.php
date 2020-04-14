<?php

use App\Constants\AppConstant;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->string('first_name');
            //todo what is file no.
            $table->string('last_name')->nullable();
            $table->unsignedBigInteger('profile_image_id')->nullable();
            $table->string('other_names')->nullable();
            $table->string('maiden_name')->nullable();
            $table->date('date_of_birth');
            $table->enum('marital_status',[
                AppConstant::EMPLOYEE_MARITAL_STATUS_MARRIED,
                AppConstant::EMPLOYEE_MARITAL_STATUS_UNMARRIED,
                AppConstant::EMPLOYEE_MARITAL_STATUS_OTHER
            ]);
            $table->enum('gender', [
                AppConstant::EMPLOYEE_GENDER_MALE,
                AppConstant::EMPLOYEE_GENDER_FEMALE
            ]);
            $table->enum('religion', [
                AppConstant::EMPLOYEE_RELIGION_HINDU,
                AppConstant::EMPLOYEE_RELIGION_OTHER
            ])->nullable();
            $table->string('phone');
            $table->string('email');
            $table->boolean('is_permanent_staff')->nullable();
            $table->enum('type_of_appointment', [
                AppConstant::EMPLOYEE_TYPE_APPOINTMENT_TENURED
            ]);
            $table->date('appointed')->nullable();
            $table->date('assumed_duty')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('profile_image_id')->references('id')->on('files');
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
        Schema::dropIfExists('employees');
    }
}
