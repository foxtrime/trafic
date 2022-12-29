<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAgenteIdToOcorrenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ocorrencias', function (Blueprint $table) {
            
            $table->bigInteger('agente_id')->unsigned()->nullable()->after('id');
            $table->foreign('agente_id')->references('id')->on('agentes');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ocorrencias', function (Blueprint $table) {
            $table->dropForeign(['agente_id']);
            $table->dropColumn('agente_id');
        });
    }
}
