<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ocorrencia_Images extends Model
{
    protected $table = "ocorrencias_images";
    protected $fillable = [
     'image',
     'ocorrencia_id'
    ];
    
    public function ocorrencia(){

        return $this->belongsToMany('App\Models\Ocorrencia');
    
        }
}
