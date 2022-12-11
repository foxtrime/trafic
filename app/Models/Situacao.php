<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Situacao extends Model
{
    protected $table = "situacoes";

    protected $fillable =[
        'nome',
        'qtd_dias_padrao',
    ];

    public function agentes()
    {
        return $this->belongsToMany('App\Models\Agente');
    }
}
