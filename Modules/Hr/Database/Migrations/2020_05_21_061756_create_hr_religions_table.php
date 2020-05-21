<?php

use App\Constants\AppConstant;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHrReligionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hr_religions', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('name', [
                AppConstant::EMPLOYEE_RELIGION_OTHER,
                AppConstant::EMPLOYEE_RELIGION_CHRISTIANITY,
                AppConstant::EMPLOYEE_RELIGION_ISLAM
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
        Schema::dropIfExists('hr_religions');
    }
}
