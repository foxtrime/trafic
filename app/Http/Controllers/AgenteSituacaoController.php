<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agente;

class AgenteSituacaoController extends Controller
{
    public function index($id)
    {

        $agente = Agente::find($id);

        return view('agente.situacao.index', compact('agente'));
    }
}
