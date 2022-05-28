<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHrLeaveRequestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hr_leave_request', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('staff_id')->nullable();
            $table->integer('leave_credit_id')->nullable();
            $table->dateTime('start_date')->nullable();
            $table->integer('relief_officer_staff_id')->nullable();
            $table->string('duration')->nullable();
            $table->dateTime('prepared_v_date')->nullable();
            $table->dateTime('prepared_t_date')->nullable();
            $table->string('prepared_login_id')->nullable();
            $table->integer('hod_staff_id')->nullable();
            $table->boolean('approved_hod')->default(false);
            $table->dateTime('approved_hod_v_date')->nullable();
            $table->dateTime('approved_hod_t_date')->nullable();
            $table->string('approved_hod_login_id')->nullable();
            $table->integer('approved_hr_staff_id')->nullable();
            $table->boolean('approved_hr')->default(false);
            $table->dateTime('approved_hr_v_date')->nullable();
            $table->dateTime('approved_hr_t_date')->nullable();
            $table->string('approved_hr_login_id')->nullable();
            $table->longText('user_remarks')->default('');
            $table->longText('hod_remarks')->default('');
            $table->longText('hr_remarks')->default('');
            $table->boolean('request_closed')->default(0);
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
        Schema::dropIfExists('hr_leave_request');
    }
}
