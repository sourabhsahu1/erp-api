<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeAppraisalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_appraisals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('fileno');
            $table->string('supervisors_fileno');
            $table->string('fullname')->nullable();
            $table->string('department')->nullable();
            $table->string('designation')->nullable();
            $table->string('qualification')->nullable();
            $table->string('doa')->nullable();
            $table->string('rank')->nullable();
            $table->string('rankdate')->nullable();
            $table->string('actingappointment')->nullable();
            $table->string('courseundertaken')->nullable();
            $table->integer('absentdays')->nullable();
            $table->string('jobduties')->nullable();
            $table->string('extraduties')->nullable();
            $table->boolean('isCompleted')->nullable();
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
        Schema::dropIfExists('employee_appraisals');
    }
}
