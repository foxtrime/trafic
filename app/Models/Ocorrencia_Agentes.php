<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ocorrencia_Agentes extends Model
{
    protected $table = "ocorrencias_agentes";
    protected $fillable = [
     'agente_id',
     'ocorrencia_id',
     'relator',
    ];
    
    public function ocorrencias(){

        return $this->belongsToMany('App\Models\Ocorrencia');
    
    }

    public function agentes()
 	{
      return $this->belongsToMany('App\Models\Agente');
 	}
}
