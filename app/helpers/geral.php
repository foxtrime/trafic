<?php

use Illuminate\Support\Facades\Auth;

use App\Models\Agente;


if(!function_exists('retiraMascaraCPF')) {
    function retiraMascaraCPF($cpf) {
        $cpf = trim($cpf);
        $cpf = str_replace(".", "", $cpf);
        $cpf = str_replace("-", "", $cpf);
        return $cpf;
    }
}


if(!function_exists('agenteLogado'))
{
    function agenteLogado() {
        $agente = Agente::with('usuario')->where('user_id','=',Auth::user()->id)->first();
        return $agente;
    }
}