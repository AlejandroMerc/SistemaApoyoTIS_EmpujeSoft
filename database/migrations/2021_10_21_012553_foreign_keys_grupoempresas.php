<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ForeignKeysGrupoempresas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('grupoempresas', function($table)
        {
            $table  ->foreign('asesor_tis_id')
                    ->references('id')->on('asesor_tiss')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table  ->foreign('rep_legal_id')
                    ->references('id')->on('estudiantes')
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
