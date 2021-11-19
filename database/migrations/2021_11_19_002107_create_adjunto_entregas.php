<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdjuntoEntregas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adjunto_entregas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('entrega_id')
                  ->references('id')->on('entregas')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->foreignId('adjunto_id')
                  ->references('id')->on('adjuntos')
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
        Schema::dropIfExists('adjunto_entregas');
    }
}
