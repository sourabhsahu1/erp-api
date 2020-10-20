<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterJvTrailBalanceAddNoteIdTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('jv_trail_balance_report', function (Blueprint $table) {
            $table->unsignedBigInteger('note_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('jv_trail_balance_report', function (Blueprint $table) {
            $table->dropColumn('note_id');
        });
    }
}
