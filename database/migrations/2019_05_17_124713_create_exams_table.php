<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exams', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('exam_name',60)->nullable();;
            $table->integer('type_question')->nullable();;
            $table->integer('question_count')->nullable();

            $table->unsignedBigInteger('author_id');
            $table->foreign("author_id")->references('id')->on('users');

            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories');


            $table->integer('exam_time')->nullable();;
            $table->integer('option_count')->nullable();
            $table->integer('cost')->nullable();
            $table->integer('why_start')->nullable();
            $table->integer('why_end')->nullable();
            $table->integer('imagin_start')->nullable();
            $table->integer('imagin_end')->nullable();
            $table->integer('words_start')->nullable();
            $table->integer('words_end')->nullable();
            $table->timestamp('start_date')->nullable();
            $table->timestamp('end_date')->nullable();;
            $table->string('desc',200)->nullable();;
            $table->string('epicaddress')->nullable();;
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
        Schema::dropIfExists('exams');
    }
}
