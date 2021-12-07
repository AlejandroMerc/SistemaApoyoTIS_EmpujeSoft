<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGruposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grupos', function (Blueprint $table) {
            $table->id();
            $table->string('sigla_grupo');
            $table->string('codigo_inscripcion');
            $table->foreignId('semestre_id')
                  ->references('id')->on('semestres')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->foreignId('asesor_id')
                ->references('id')->on('asesores')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('grupos');
    }
}
