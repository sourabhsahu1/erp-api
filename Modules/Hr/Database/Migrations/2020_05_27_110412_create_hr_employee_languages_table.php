<?php

use App\Constants\AppConstant;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHrEmployeeLanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hr_employee_languages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('employee_id');
            $table->unsignedBigInteger('language_id');
            $table->enum('written_proficiency',[
                AppConstant::LANGUAGE_PROFICIENCY_NO,
                AppConstant::LANGUAGE_PROFICIENCY_POOR,
                AppConstant::LANGUAGE_PROFICIENCY_GOOD,
                AppConstant::LANGUAGE_PROFICIENCY_VERY_GOOD
            ]);
            $table->enum('spoken_proficiency',[
                AppConstant::LANGUAGE_PROFICIENCY_NO,
                AppConstant::LANGUAGE_PROFICIENCY_POOR,
                AppConstant::LANGUAGE_PROFICIENCY_GOOD,
                AppConstant::LANGUAGE_PROFICIENCY_VERY_GOOD
            ]);
            $table->string('certification')->nullable();
            $table->string('description')->nullable();
            $table->foreign('employee_id')->references('id')->on('hr_employees');
            $table->foreign('language_id')->references('id')->on('hr_languages');
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
        Schema::dropIfExists('hr_employee_languages');
    }
}
