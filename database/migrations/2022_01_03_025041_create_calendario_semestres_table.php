<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalendarioSemestresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calendario_semestres', function (Blueprint $table) {
            $table->id();
            $table->foreignId('calendario_id')
            ->references('id')->on('calendarios')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreignId('semestre_id')
            ->references('id')->on('semestres')
            ->onUpdate('cascade')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('calendario_semestres');
    }
}
