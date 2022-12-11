<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sequencia extends Model
{
    protected $table = "sequencias";

    protected $fillable = [
        'numero_requerimento',
        'numero_ocorrencia',
    ];
}
