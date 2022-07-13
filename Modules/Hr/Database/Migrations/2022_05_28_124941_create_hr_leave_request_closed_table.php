<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHrLeaveRequestClosedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hr_leave_request_closed', function (Blueprint $table) {
            $table->unique(['leave_request_id']);
            $table->bigIncrements('id');
            $table->integer('leave_request_id')->nullable();
            $table->integer('days_spent')->nullable();
            $table->dateTime('prepared_v_date')->nullable();
            $table->dateTime('prepared_t_date')->nullable();
            $table->string('prepared_login_id')->nullable();
            $table->boolean('request_ready')->default(0);
            $table->integer('hod_staff_id')->nullable();
            $table->string('approved_hod')->default('pending');
            $table->dateTime('approved_hod_v_date')->nullable();
            $table->dateTime('approved_hod_t_date')->nullable();
            $table->string('approved_hod_login_id')->nullable();
            $table->integer('approved_hr_staff_id')->nullable();
            $table->string('approved_hr')->default('pending');
            $table->dateTime('approved_hr_v_date')->nullable();
            $table->dateTime('approved_hr_t_date')->nullable();
            $table->string('approved_hr_login_id')->nullable();
            $table->longText('user_remarks')->nullable();
            $table->longText('hod_remarks')->nullable();
            $table->longText('hr_remarks')->nullable();
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
        Schema::dropIfExists('hr_leave_request_closed');
    }
}
