<?php

use App\Constants\AppConstant;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJournalVouchersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('journal_vouchers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('source_app');
            $table->string('batch_number');
            $table->date('jv_value_date');
            $table->unsignedInteger('fund_segment_id');
            $table->string('jv_reference_number');
            $table->enum('status',[
                AppConstant::JV_STATUS_NEW,
                AppConstant::JV_STATUS_POSTED,
                AppConstant::JV_STATUS_CHECKED
            ]);
            $table->string('transaction_details');
            $table->date('prepared_value_date')->nullable();
            $table->date('prepared_transaction_date')->nullable();
            $table->date('checked_value_date')->nullable();
            $table->date('checked_transaction_date')->nullable();
            $table->date('posted_value_date')->nullable();
            $table->date('posted_transaction_date')->nullable();
            $table->unsignedBigInteger('prepared_user_id')->nullable();
            $table->unsignedBigInteger('checked_user_id')->nullable();
            $table->unsignedBigInteger('posted_user_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('fund_segment_id')->references('id')->on('admin_segments');
            $table->foreign('prepared_user_id')->references('id')->on('users');
            $table->foreign('checked_user_id')->references('id')->on('users');
            $table->foreign('posted_user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('journal_vouchers');
    }
}
