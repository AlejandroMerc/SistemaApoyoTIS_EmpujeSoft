<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalendarioGrupoempresasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calendario_grupoempresas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('calendario_id')
            ->references('id')->on('calendarios')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreignId('grupoempresa_id')
            ->references('id')->on('grupoempresas')
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
        Schema::dropIfExists('calendario_grupoempresas');
    }
}
