<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Agente extends Model
{
    use SoftDeletes;

    protected $table = "agentes";

    protected $fillable = [
        'user_id',
        'nome_servico',
        'sexo',
        'nascimento',
        'matricula',
        'cargo_id',
        'admissao',
        'ts',
        'cnh',
        'categoria_cnh',
        'validade_cnh',
        'municipio',
        'bairro',
        'logradouro',
        'numero',
        'complemento',
        'cep',
        'telefone1',
        'telefone2',
        'telefone3',
        'obs',
        'situacao',
        'foto',
        'altura',
        'camisa',
        'peso',
        'calca',
        'sapato',
        'tenis',
        'coturno',
        'colete',
    ];

    public function cargo()
 	{
		return $this->belongsTo('App\Models\Cargo','cargo_id');
 	}

    public function usuario()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function ocorrencias()
    {
        return $this->belongsToMany(Ocorrencia::class, 'ocorrencias_agentes')->withPivot('relator');
    }

}
