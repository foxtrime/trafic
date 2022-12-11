<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ConfigCategoria extends Model
{
    use SoftDeletes;

    protected $table = "config_categorias";

    protected $fillable =[
        'nome'
    ];

    public function ocorrencia()
    {
        return $this->hasMany('App\Models\Ocorrencia');
    }
    
}
