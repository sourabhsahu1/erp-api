<?php

use App\Constants\AppConstant;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHrMarriageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hr_marriage', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('status',[
                AppConstant::EMPLOYEE_MARITAL_STATUS_MARRIED,
                AppConstant::EMPLOYEE_MARITAL_STATUS_SINGLE,
                AppConstant::EMPLOYEE_MARITAL_STATUS_DIVORCED,
                AppConstant::EMPLOYEE_MARITAL_STATUS_WIDOWED,
                AppConstant::EMPLOYEE_MARITAL_STATUS_OTHER,
            ]);
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
        Schema::dropIfExists('hr_marriage');
    }
}
