<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ConfigTipo extends Model
{
    use SoftDeletes;

    protected $table = "config_tipos";

    protected $fillable =[
        'nome'
    ];

    public function ocorrencia()
    {
        return $this->hasMany('App\Models\Ocorrencia');
    }
    
}
