<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ConfigSetor extends Model
{
    use SoftDeletes;

    protected $table = "config_setors";

    protected $fillable =[
        'nome'
    ];

    public function ocorrencia()
    {
        return $this->hasMany('App\Models\Ocorrencia');
    }
    
}
