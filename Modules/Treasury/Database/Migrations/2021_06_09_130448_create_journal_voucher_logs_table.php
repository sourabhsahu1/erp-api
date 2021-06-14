<?php

use App\Constants\AppConstant;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJournalVoucherLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('journal_voucher_logs', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('journal_voucher_id');
            $table->enum('previous_status',[
                AppConstant::JV_STATUS_NEW,
                AppConstant::JV_STATUS_POSTED,
                AppConstant::JV_STATUS_CHECKED
            ])->nullable();
            $table->enum('current_status',[
                AppConstant::JV_STATUS_NEW,
                AppConstant::JV_STATUS_POSTED,
                AppConstant::JV_STATUS_CHECKED
            ]);
            $table->date('date');
            $table->timestamps();
            $table->softDeletes();
            $table->unsignedBigInteger('admin_id');
            $table->foreign('admin_id')->references('id')->on('users');
            $table->foreign('journal_voucher_id')->references('id')->on('journal_vouchers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('journal_voucher_logs');
    }
}
