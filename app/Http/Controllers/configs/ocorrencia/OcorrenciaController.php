<?php

namespace App\Http\Controllers\configs\ocorrencia;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ConfigAtendimento;
use App\Models\ConfigCategoria;
use App\Models\ConfigClima;
use App\Models\ConfigConducao;
use App\Models\ConfigSetor;
use App\Models\ConfigTipo;
use App\Models\ConfigTransportado;

class OcorrenciaController extends Controller
{
    public function atendimento_index ()
    {

        $nomes = ConfigAtendimento::all();

        return view('configs/ocorrencia/atendimento.index', compact('nomes'));
    }

    public function atendimento_create ()
    {
        return view('configs/ocorrencia/atendimento.create');
    }

    public function atendimento_store (Request $request)
    {

        $dados = new ConfigAtendimento;

        $dados->nome = $request->nome;

        $dados->save();

        return redirect()->route('atendimento.index');

        
    }

    public function tipo_index ()
    {
        $nomes = ConfigTipo::all();

        return view('configs/ocorrencia/tipo.index', compact('nomes'));
    }

    public function tipo_create ()
    {
        return view('configs/ocorrencia/tipo.create');
    }

    public function tipo_store (Request $request)
    {
        // ConfigTipo
        $dados = new ConfigTipo;

        $dados->nome = $request->nome;

        $dados->save();

        return redirect()->route('tipo.index');
    }

    public function clima_index ()
    {
        $nomes = ConfigClima::all();

        return view('configs/ocorrencia/clima.index', compact('nomes'));
    }

    public function clima_create ()
    {
        return view('configs/ocorrencia/clima.create');
    }

    public function clima_store (Request $request)
    {
        // ConfigClima
        $dados = new ConfigClima;

        $dados->nome = $request->nome;

        $dados->save();

        return redirect()->route('clima.index');
    }

    public function transportado_index ()
    {
        $nomes = ConfigTransportado::all();

        return view('configs/ocorrencia/transportado.index', compact('nomes'));
    }

    public function transportado_create ()
    {
        return view('configs/ocorrencia/transportado.create');
    }

    public function transportado_store (Request $request)
    {
        // ConfigTransportado
        $dados = new ConfigTransportado;

        $dados->nome = $request->nome;

        $dados->save();

        return redirect()->route('transportado.index');
    }

    public function conducao_index ()
    {
        $nomes = ConfigConducao::all();

        return view('configs/ocorrencia/conducao.index', compact('nomes'));
    }

    public function conducao_create ()
    {
        return view('configs/ocorrencia/conducao.create');
    }

    public function conducao_store (Request $request)
    {
        // ConfigConducao
        $dados = new ConfigConducao;

        $dados->nome = $request->nome;

        $dados->save();

        return redirect()->route('conducao.index');
    }

    public function setor_index ()
    {
        $nomes = ConfigSetor::all();

        return view('configs/ocorrencia/setor.index', compact('nomes'));
    }

    public function setor_create ()
    {
        return view('configs/ocorrencia/setor.create');
    }

    public function setor_store (Request $request)
    {
        // ConfigSetor
        $dados = new ConfigSetor;

        $dados->nome = $request->nome;

        $dados->save();

        return redirect()->route('setor.index');
    }

    public function categoria_index ()
    {
        $nomes = ConfigCategoria::all();

        return view('configs/ocorrencia/categoria.index', compact('nomes'));
    }

    public function categoria_create ()
    {
        return view('configs/ocorrencia/categoria.create');
    }

    public function categoria_store (Request $request)
    {
        // ConfigCategoria
        $dados = new ConfigCategoria;

        $dados->nome = $request->nome;

        $dados->save();

        return redirect()->route('categoria.index');
    }

  
}
