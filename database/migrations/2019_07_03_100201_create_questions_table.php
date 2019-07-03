<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('intitule', 150);
            $table->integer('reponse')->nullable()->default(0);
            $table->integer('quiz_id');
            $table->integer('points')->nullable()->default(12);
            $table->string('media')->nullable();
            $table->timestamps();


            $table->foreign('quiz_id')->references('id')->on('quizs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('questions');
    }
}
