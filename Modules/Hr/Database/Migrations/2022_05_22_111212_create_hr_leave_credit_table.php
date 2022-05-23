<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHrLeaveCreditTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hr_leave_credit', function (Blueprint $table) {
            $table->unique(['staff_id', 'leave_type_id','leave_year_id']);
            $table->bigIncrements('id');
            $table->integer('prepared_login_id');
            $table->integer('staff_id');
            $table->integer('leave_type_id');
            $table->integer('due_days');
            $table->integer('leave_year_id');
            $table->dateTime('prepared_v_date');
            $table->dateTime('prepared_t_date');

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
        Schema::dropIfExists('hr_leave_credit');
    }
}
