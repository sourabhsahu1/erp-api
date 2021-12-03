<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AppraisalsData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('appraisals_datas', function(Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('fileno');
            $table->string('fullname')->nullable();
            $table->string('department')->nullable();
            $table->string('designation')->nullable();
            $table->string('qualification')->nullable();
            $table->string('doa')->nullable();
            $table->string('rank')->nullable();
            $table->string('rankdate')->nullable();
            $table->string('actingappointment')->nullable();
            $table->string('courseundertaken')->nullable();
            $table->integer('absentdays')->nullable();
            $table->string('jobduties')->nullable();
            $table->string('extraduties')->nullable();

            $table->boolean('agree')->nullable();
            $table->string('performance')->nullable();
            $table->string('foresight_option')->nullable();
            $table->string('judgement_option')->nullable();
            $table->string('paper_option')->nullable();
            $table->string('oral_option')->nullable();
            $table->string('numerical')->nullable();
            $table->string('relations')->nullable();
            $table->string('public_option')->nullable();
            $table->string('acceptance')->nullable();
            $table->string('reliability')->nullable();
            $table->string('drive')->nullable();
            $table->string('application')->nullable();
            $table->string('management')->nullable();
            $table->string('output')->nullable();
            $table->string('work')->nullable();
            $table->string('punctuality')->nullable();
            $table->string('outstanding')->nullable();
            $table->string('verygood')->nullable();
            $table->string('generally')->nullable();
            $table->string('moderate')->nullable();
            $table->string('ineffective')->nullable();
            $table->text('comment')->nullable();
            $table->boolean('confirm')->nullable();
            $table->string('level')->nullable();
            $table->string('title')->nullable();
            $table->string('dated')->nullable();

            $table->text('needed')->nullable();
            $table->text('recommended')->nullable();
            $table->boolean('job')->nullable();
            $table->boolean('joblevel')->nullable();
            $table->text('reasons')->nullable();
            $table->string('fitting')->nullable();
            $table->string('position')->nullable();
            $table->text('comment-recommendation')->nullable();
            $table->string('considered')->nullable();
            $table->text('reason')->nullable();
            $table->boolean('future')->nullable();
            $table->boolean('near')->nullable();
            $table->boolean('potential')->nullable();
            $table->boolean('exceptional')->nullable();
            $table->text('additional')->nullable();
            $table->string('served')->nullable();
            $table->boolean('agreed')->nullable();
            $table->string('grade')->nullable();
            $table->date('day')->nullable();
            $table->string('blockname')->nullable();

            $table->text('reportconfirmation')->nullable();
            $table->boolean('agreement')->nullable();
            $table->string('grading')->nullable();
            $table->date('serve')->nullable();
            $table->string('blockfullname')->nullable();

            $table->string('emailaddress')->nullable();
            $table->string('dispute')->nullable();

            $table->boolean('isDisputable')->nullable();
            $table->boolean('isConsiderable')->nullable();
            $table->boolean('isCompleted')->nullable();
            $table->boolean('isAwardable')->nullable();

            $table->timestamps();
        } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('appraisals_data');
    }
}
