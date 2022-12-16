<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOcorrenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ocorrencias', function (Blueprint $table) {
            $table->id();
            
            // SEQUENCIA
            $table->string('sequencia', 20);

            // STATUS
            $table->boolean('enviado')          ->default(false);

            $table->date('data')                      ->nullable();
            $table->time('hora')                      ->nullable();
            $table->text('envolvidos')                ->nullable();
            $table->text('relato');
            $table->text('providencia');


            $table->BigInteger('conducao_id')->unsigned()->nullable();
            $table->BigInteger('setor_id')->unsigned()->nullable();
            $table->BigInteger('tipo_id')->unsigned()->nullable();
            $table->BigInteger('atendimento_id')->unsigned()->nullable();
            $table->BigInteger('clima_id')->unsigned()->nullable();
            $table->BigInteger('transportado_id')->unsigned()->nullable();
            
            $table->foreign('conducao_id')->references('id')->on('config_conducaos');
            $table->foreign('setor_id')->references('id')->on('config_setors');
            $table->foreign('tipo_id')->references('id')->on('config_tipos');
            $table->foreign('atendimento_id')->references('id')->on('config_atendimentos');
            $table->foreign('clima_id')->references('id')->on('config_climas');
            $table->foreign('transportado_id')->references('id')->on('config_transportados');


            // ENDERECO
            $table->string('bairro',20)                     ->nullable();
            $table->string('logradouro',100)                ->nullable();
            $table->string('numero',10)                     ->nullable();
            $table->string('complemento',100)               ->nullable();
            $table->string('municipio',100)                 ->nullable();
            $table->char('cep',10)                          ->nullable();
            $table->decimal('latitude',10,8)                ->nullable();
            $table->decimal('longitude',10,8)               ->nullable();



            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ocorrencias');
    }
}
