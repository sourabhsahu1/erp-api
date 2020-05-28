<?php

use App\Constants\AppConstant;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHrEmployeeRelationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hr_employee_relations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('employee_id');
            $table->unsignedBigInteger('relationship_id');
            $table->unsignedBigInteger('relative_id')->nullable();
            $table->string('last_name')->nullable();
            $table->string('first_name');
            $table->string('national_id');
            $table->enum('gender', [
                AppConstant::EMPLOYEE_GENDER_MALE,
                AppConstant::EMPLOYEE_GENDER_FEMALE
            ]);
            $table->date('date_of_birth');
            $table->boolean('is_next_of_kin')->default(0);
            $table->unsignedBigInteger('country_id');
            $table->unsignedBigInteger('region_id');
            $table->unsignedBigInteger('state_id');
            $table->unsignedBigInteger('lga_id');
            $table->string('address_line_1');
            $table->string('address_line_2')->nullable();
            $table->string('city')->nullable();
            $table->string('zip_code');
            $table->foreign('employee_id')->references('id')->on('hr_employees');
            $table->foreign('relationship_id')->references('id')->on('hr_relationships');
            $table->foreign('relative_id')->references('id')->on('hr_employees');
            $table->foreign('country_id')->references('id')->on('countries');
            $table->foreign('region_id')->references('id')->on('regions');
            $table->foreign('state_id')->references('id')->on('states');
            $table->foreign('lga_id')->references('id')->on('lgas');
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
        Schema::dropIfExists('hr_employee_relations');
    }
}
