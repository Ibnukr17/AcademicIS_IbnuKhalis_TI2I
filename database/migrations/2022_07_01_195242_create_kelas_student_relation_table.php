<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKelasStudentRelationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('student', function (Blueprint $table) {
            $table->dropColumn('kelas'); //delete class column
            $table->unsignedBigInteger('kelas_id')->nullable();//add kelas_id column
            $table->foreign('kelas_id')->references('id')->on('kelas');//add foreign key in kelas_id column
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('student', function (Blueprint $table) {
            $table->string('kelas');
            $table->dropForeign(['kelas_id']);
        });
    }
}
