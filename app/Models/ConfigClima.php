<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ConfigClima extends Model
{
    use SoftDeletes;

    protected $table = "config_climas";

    protected $fillable =[
        'nome'
    ];

    public function ocorrencia()
    {
        return $this->hasMany('App\Models\Ocorrencia');
    }
    
}
