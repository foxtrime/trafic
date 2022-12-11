<?php

use Illuminate\Database\Seeder;

class SituacaoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('situacoes')->insert(['nome'	=>	'FÉRIAS', 	'qtd_dias_padrao'	=> '30']);
		DB::table('situacoes')->insert(['nome'	=>	'DEMISSÃO', 	'qtd_dias_padrao'	=> '-1']);
		DB::table('situacoes')->insert(['nome'	=>	'ÓBITO', 	'qtd_dias_padrao'	=> '-1']);
		DB::table('situacoes')->insert(['nome'	=>	'APOSENTADORIA', 	'qtd_dias_padrao'	=> '-1']);
		DB::table('situacoes')->insert(['nome'	=>	'LICENÇA PRÊMIO POR ASSIDUIDADE', 	'qtd_dias_padrao'	=> '152']);
		DB::table('situacoes')->insert(['nome'	=>	'LICENÇA PARA TRATAMENTO DE SAÚDE', 	'qtd_dias_padrao'	=> '0']);
		DB::table('situacoes')->insert(['nome'	=>	'LICENÇA POR MOTIVO DE DOENÇA EM PESSOA DA FAMÍLIA', 	'qtd_dias_padrao'	=> '0']);
		DB::table('situacoes')->insert(['nome'	=>	'LICENÇA PARA TRATAR DE INTERESSES PARTICULARES', 	'qtd_dias_padrao'	=> '0']);
		DB::table('situacoes')->insert(['nome'	=>	'LICENÇA PARA CAPACITAÇÃO', 	'qtd_dias_padrao'	=> '0']);
		DB::table('situacoes')->insert(['nome'	=>	'LICENÇA PARA ATIVIDADE POLÍTICA', 	'qtd_dias_padrao'	=> '0']);
		DB::table('situacoes')->insert(['nome'	=>	'LICENÇA PARA DESEMPENHO DE MANDATO CLASSISTA', 	'qtd_dias_padrao'	=> '0']);
		DB::table('situacoes')->insert(['nome'	=>	'LICENÇA POR MOTIVO DE AFASTAMENTO DE CÔNJUGE', 	'qtd_dias_padrao'	=> '0']);
		DB::table('situacoes')->insert(['nome'	=>	'LICENÇA MATERNIDADE', 	'qtd_dias_padrao'	=> '120']);
		DB::table('situacoes')->insert(['nome'	=>	'LICENÇA PATERNIDADE', 	'qtd_dias_padrao'	=> '5']);
		DB::table('situacoes')->insert(['nome'	=>	'LICENÇA ADOTANTE', 	'qtd_dias_padrao'	=> '120']);
		DB::table('situacoes')->insert(['nome'	=>	'LICENÇA CASAMENTO', 	'qtd_dias_padrao'	=> '3']);
		DB::table('situacoes')->insert(['nome'	=>	'LICENÇA ÓBITO', 	'qtd_dias_padrao'	=> '2']);
		DB::table('situacoes')->insert(['nome'	=>	'LICENÇA PARA O SERVIÇO MILITAR', 	'qtd_dias_padrao'	=> '99999']);
		DB::table('situacoes')->insert(['nome'	=>	'AFASTAMENTO PARA SERVIR A OUTRO ORGÃO', 	'qtd_dias_padrao'	=> '99999']);
		DB::table('situacoes')->insert(['nome'	=>	'AFASTAMENTO PARA O EXERCÍCIO DE MANDATO ELETIVO', 	'qtd_dias_padrao'	=> '99999']);
		DB::table('situacoes')->insert(['nome'	=>	'AFASTAMENTO PARA ESTUDO NO EXTERIOR', 	'qtd_dias_padrao'	=> '99999']);
		DB::table('situacoes')->insert(['nome'	=>	'PRONTO', 	'qtd_dias_padrao'	=> '999999']);
    }
}
