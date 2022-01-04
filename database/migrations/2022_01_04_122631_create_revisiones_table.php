<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRevisionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('revisiones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('actividad_id')
            ->references('id')->on('actividades')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreignId('grupoempresa_id')
            ->references('id')->on('grupoempresas')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->dateTime('fecha_revision');
            $table->string('estado',255);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('revisiones');
    }
}
