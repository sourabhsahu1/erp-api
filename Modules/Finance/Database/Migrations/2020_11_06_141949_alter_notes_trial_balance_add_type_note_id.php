<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterNotesTrialBalanceAddTypeNoteId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('notes_trail_balance_report', function (Blueprint $table) {
            $table->string('note_id')->nullable();
            $table->string('type')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('notes_trail_balance_report', function (Blueprint $table) {
            $table->dropColumn('note_id');
            $table->dropColumn('type');
        });
    }
}
