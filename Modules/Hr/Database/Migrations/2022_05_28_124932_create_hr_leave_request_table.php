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
            $table->integer('staff_id');
            $table->integer('leave_credit_id');
            $table->dateTime('start_date');

            $table->integer('relief_officer_staff_id');
            $table->integer('duration');
            $table->dateTime('prepared_v_date');
            $table->dateTime('prepared_t_date');
            $table->integer('prepared_login_id');
            $table->integer('hod_staff_id');
            $table->boolean('approved_hod')->default(false);
            $table->dateTime('approved_hod_v_date');
            $table->dateTime('approved_hod_t_date');
            $table->integer('approved_hod_login_id');
            $table->integer('approved_hr_staff_id');
            $table->boolean('approved_hr')->default(false);
            $table->dateTime('approved_hr_v_date');
            $table->dateTime('approved_hr_t_date');
            $table->integer('approved_hr_login_id');
            $table->longText('user_remarks');
            $table->longText('hod_remarks');
            $table->longText('hr_remarks');
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
