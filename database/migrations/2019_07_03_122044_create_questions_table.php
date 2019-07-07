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
            $table->increments('id');
            $table->string('intitule', 150);
            $table->integer('reponse')->nullable()->default(0);
            $table->integer('quize_id')->unsigned();
            $table->integer('categorie_id')->unsigned();
            $table->integer('points')->nullable()->default(0);
            $table->string('media')->nullable();
            $table->timestamps();

            $table->foreign('quize_id')->references('id')->on('quizes')->onDelete('cascade');
            $table->foreign('categorie_id')->references('id')->on('categories')->onDelete('cascade');
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
