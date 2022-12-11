<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgentesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agentes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')  	                                ->unsigned();

            $table->string('nome_servico',50)                               ->nullable();
            $table->string('sexo')                                          ->nullable();
            $table->date('nascimento')                                      ->nullable();
            $table->bigInteger('cargo_id')  	                            ->unsigned();
            $table->date('admissao')                                        ->nullable();
            $table->string('matricula', 12)                                 ->nullable();
            
            $table->char('ts',3)                                            ->nullable();
            $table->char('cnh',11)                                          ->nullable();
            $table->char('categoria_cnh',3)                                 ->nullable();
            $table->date('validade_cnh',12)                                 ->nullable();

            /* endereço */
           	$table->string('municipio',100)                                 ->nullable();
			$table->string('bairro',30)                                     ->nullable();
			$table->string('logradouro',100)                                ->nullable();
			$table->string('numero',10)                                     ->nullable();
			$table->string('complemento',100)                               ->nullable();
            $table->char('cep',10)                                          ->nullable();
            
            /* telefones  */
            $table->string('telefone1',15)                                  ->nullable();
            $table->string('telefone2',15)                                  ->nullable();
            $table->string('telefone3',15)                                  ->nullable();
            $table->text('obs')                                             ->nullable();

            $table->string('situacao',50)                                   ->nullable();
            $table->string('foto')                                          ->nullable();

            // ANTROPOMETRICOS
            $table->float('altura')                                         ->nullable();
            $table->string('camisa',4)                                      ->nullable();
            $table->tinyInteger('peso')                                     ->nullable();
            $table->tinyInteger('calca')                                    ->nullable();
            $table->tinyInteger('sapato')                                   ->nullable();
            $table->tinyInteger('tenis')                                    ->nullable();
            $table->tinyInteger('coturno')                                  ->nullable();
            $table->string('colete',4)                                      ->nullable();

            $table->softDeletes();

            $table->timestamps();
        });

        Schema::table('agentes', function($table){
            $table->foreign('user_id')  ->references('id')->on('users');
            $table->foreign('cargo_id') ->references('id')->on('cargos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agentes');
    }
}
