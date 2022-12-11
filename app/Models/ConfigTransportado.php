<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Model;

class ConfigTransportado extends Model
{
    use SoftDeletes;

    protected $table = "config_transportados";

    protected $fillable =[
        'nome'
    ];

    public function ocorrencia()
    {
        return $this->hasMany('App\Models\Ocorrencia');
    }

}
