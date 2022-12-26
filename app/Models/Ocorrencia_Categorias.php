<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ocorrencia_Categorias extends Model
{
    protected $table = "ocorrencias_categorias";
    protected $fillable = [
     'categoria_id',
     'ocorrencia_id',
     'relator',
    ];
    
    public function ocorrencia(){

        return $this->belongsToMany('App\Models\Ocorrencia');
    
    }
}
