<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePublicacionSemestres extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('publicacion_semestres', function (Blueprint $table) {
            $table->id();
            $table->foreignId('publicacion_id')
                  ->references('id')->on('publicaciones')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->foreignId('semestre_id')
                  ->references('id')->on('semestres')
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
        Schema::dropIfExists('publicacion_semestres');
    }
}
