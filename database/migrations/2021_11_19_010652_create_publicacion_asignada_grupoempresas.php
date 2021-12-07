<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePublicacionAsignadaGrupoempresas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('publicacion_grupoempresas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('publicacion_id')
                  ->references('id')->on('publicaciones')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->foreignId('grupoempresa_id')
                  ->references('id')->on('grupoempresas')
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
        Schema::dropIfExists('publicacion_grupoempresas');
    }
}
