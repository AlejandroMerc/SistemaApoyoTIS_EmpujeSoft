<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdjuntoLogosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adjunto_logos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('grupoempresa_id')
            ->references('id')->on('grupoempresas')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreignId('adjunto_id')
            ->references('id')->on('adjuntos')
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
        Schema::dropIfExists('adjunto_logos');
    }
}
