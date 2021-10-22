<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ForeignKeysEstudiantes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('estudiantes', function($table)
        {
            $table  ->foreign('grupo_id')
                    ->references('id')->on('grupos')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table  ->foreign('grupoempresa_id')
                    ->references('id')->on('grupoempresas')
                    ->nullable()
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
        //
    }
}
