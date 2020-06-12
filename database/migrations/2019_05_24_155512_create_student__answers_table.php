
<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student__answers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_exam_id')->unsigned();
            $table->foreign('user_exam_id')->references('id')->on('user__exams')->onDelete('cascade');;
            $table->bigInteger('option_id')->unsigned()->nullable();
            $table->string('answer`',60)->nullable();

            $table->foreign('option_id')->references('id')->on('options')->onDelete('cascade');;
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
        Schema::dropIfExists('student__answers');
    }
}
