<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHrLeavesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hr_leaves', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('short_name');
            $table->boolean('entitled_annually');
            $table->boolean('is_paid_leave');
            $table->boolean('is_calender_days');
            $table->boolean('roll_over_unused_leave');
            $table->boolean('is_active')->default(1);
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
        Schema::dropIfExists('hr_leaves');
    }
}
