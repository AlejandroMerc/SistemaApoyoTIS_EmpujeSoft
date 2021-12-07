<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActividads extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actividades', function (Blueprint $table) {
            $table->id();
            $table->dateTime('fecha_inicio_actividad', $precision = 0);
            $table->dateTime('fecha_fin_actividad', $precision = 0);
            $table->integer('cantidad_archivos_perm');
            $table->string('tipo_archivos_perm');
            $table->foreignId('publicacion_id')
                  ->references('id')->on('publicaciones')
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
        Schema::dropIfExists('actividades');
    }
}
