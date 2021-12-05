<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGrupoempresasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grupoempresas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('grupo_id')
                  ->nullable()
                  ->references('id')->on('grupos')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->foreignId('rep_legal_id')
                  ->nullable()
                  ->references('id')->on('estudiantes')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->string('nombre_largo')->unique()->nullable();
            $table->string('nombre_corto')->unique();
            $table->string('email')->unique()->nullable();
            $table->string('tipo_sociedad')->nullable();
            $table->string('direccion_ge')->nullable();
            $table->integer('telefono_ge')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('grupoempresas');
    }
}
