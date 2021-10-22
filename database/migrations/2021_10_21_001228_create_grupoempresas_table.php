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
            $table->increments('id');
            $table->string('nombre_largo');
            $table->string('nombre_corto');
            $table->string('tipo_sociedad');
            $table->string('direccion_ge');
            $table->integer('telefono_ge');
            $table->integer('asesor_tis_id')->unsigned();
            $table->integer('rep_legal_id')->unsigned();
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
