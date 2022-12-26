<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ocorrencia extends Model
{
    protected $table = 'ocorrencias';


    protected $fillable = [
        'data',
        'hora',
        'atendimento_id',
        'tipo_id',
        'clima_id',
        'transportado_id',
        'conducao_id',
        'setor_id',
        'cep',
        'bairro',
        'logradouro',
        'numero',
        'complemento',
        'envolvidos',
        'relato',
        'providencia',
    ];


    public function categorias()
    {
        return $this->belongsToMany('App\Models\ConfigCategoria', 'ocorrencias_categorias','ocorrencia_id','categoria_id');
    }

    public function ocorrencia_agentes()
    {

    }
    
    public function imagens()
    {
        return $this->hasMany('App\Models\Ocorrencia_Images');    
    }

    public function agentes()
    {
        return $this->belongsToMany('App\Models\Agente', 'ocorrencias_agentes', 'ocorrencia_id', 'agente_id')->withPivot('relator');
    }

    public function agente()
    {
        return $this->belongsTo('App\Models\Agente', 'agente_id');
    }

    public function atendimento()
    {
        return $this->belongsTo('App\Models\ConfigAtendimento');
    }

    public function categoria()
    {
        return $this->belongsTo('App\Models\ConfigCategoria');
    }

    public function clima()
    {
        return $this->belongsTo('App\Models\ConfigClima');
    }

    public function conducao()
    {
        return $this->belongsTo('App\Models\ConfigConducao');
    }

    public function setor()
    {
        return $this->belongsTo('App\Models\ConfigSetor');
    }

    public function tipo()
    {
        return $this->belongsTo('App\Models\ConfigTipo');
    }

    public function transportado()
    {
        return $this->belongsTo('App\Models\ConfigTransportado');
    }
}
