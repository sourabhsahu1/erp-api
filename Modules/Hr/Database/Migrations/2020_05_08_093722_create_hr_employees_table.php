<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHrEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hr_employees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('personnel_file_number')->unique()->nullable();
            $table->string('last_name')->nullable();
            $table->string('first_name');
            $table->string('other_name')->nullable();
            $table->string('title');
            $table->unsignedBigInteger('profile_image_id')->nullable();
            $table->string('maiden_name')->nullable();
            $table->unsignedBigInteger('created_by_id');
            $table->foreign('profile_image_id')->references('id')->on('files');
            $table->foreign('created_by_id')->references('id')->on('users');
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
        Schema::dropIfExists('hr_employees');
    }
}
