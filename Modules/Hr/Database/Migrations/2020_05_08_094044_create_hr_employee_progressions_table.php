<?php

use App\Constants\AppConstant;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHrEmployeeProgressionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hr_employee_progressions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('employee_id');
            $table->enum('status', [
                AppConstant::PROGRESSION_STATUS_ACTIVE,
                AppConstant::PROGRESSION_STATUS_NEW,
                AppConstant::PROGRESSION_STATUS_RETIRE
            ]);

            $table->date('confirmation_due_date')->nullable();
            $table->date('confirmed_date')->nullable();
            //todo check is_confirmed manage from logic

            $table->date('last_increment')->nullable();
            $table->date('next_increment_due_date')->nullable();

            $table->date('last_promoted')->nullable();
            $table->date('next_promotion_due_date')->nullable();


            $table->date('expected_exit_date')->nullable();
            $table->date('actual_exit_date')->nullable();
            //todo check is_exited managed from logic

            $table->foreign('employee_id')->references('id')->on('hr_employees');
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
        Schema::dropIfExists('hr_employee_progressions');
    }
}
