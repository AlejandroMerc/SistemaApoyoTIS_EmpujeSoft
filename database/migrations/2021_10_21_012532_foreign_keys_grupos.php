<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ForeignKeysGrupos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('grupos', function($table)
        {
            $table  ->foreign('semestre_id')
                    ->references('id')->on('semestres')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table  ->foreign('asesor_tis_id')
                    ->references('id')->on('asesor_tiss')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
        });
    }

    /**
     * 
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
