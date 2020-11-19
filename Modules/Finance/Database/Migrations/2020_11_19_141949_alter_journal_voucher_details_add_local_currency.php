<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterJournalVoucherDetailsAddLocalCurrency extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('journal_voucher_details', function (Blueprint $table) {
            $table->string('local_currency')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('journal_voucher_details', function (Blueprint $table) {
            $table->dropColumn('local_currency');
        });
    }
}
