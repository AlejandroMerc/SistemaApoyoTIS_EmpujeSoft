<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntregas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entregas', function (Blueprint $table) {
            $table->id();
            $table->dateTime('fecha_entrega', $precision = 0);
            $table->foreignId('actividad_id')
                  ->references('id')->on('actividades')
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
        Schema::dropIfExists('entregas');
    }
}
