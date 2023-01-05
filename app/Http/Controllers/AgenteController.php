<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Cargo;
use App\Models\Agente;
use App\Models\Situacao;
use Carbon\Carbon;
use DataTables;
use Auth;




class AgenteController extends Controller
{
    public function index()
    {
        $filtro_situacao = "TODOS";

        $agentes				= Agente::with('usuario')->get();
        
        $situacoes 			= DB::table('situacoes')
            ->select(DB::raw('situacoes.nome, count(*) as total'))
                ->rightJoin('agentes', 'situacoes.nome', '=', 'agentes.situacao')
                    ->groupBy('situacoes.nome')->get();

        

        return view('agente.index', compact('filtro_situacao','agentes','situacoes'));
    }

    public function create()
    {

        $cargos = Cargo::all();

        return view('agente.create', compact('cargos'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try{

            $user           = new User;
            $user->name     = $request->nome;
            $user->email    = $request->email;
            $user->cpf      = $request->cpf;
            $user->tipo     = $request->tipo;
            
            $password = retiraMascaraCPF($request->cpf);
            $user->password 		= bcrypt($password);
            
            $user->save();

            $agente                  = new Agente;
            $agente->user_id         = $user->id;
            $agente->nome_servico    = $request->nome_servico;
            $agente->sexo            = $request->sexo;
			$agente->nascimento      = Carbon::parse($request->nascimento)->format('Y-m-d');
            $agente->cargo_id        = $request->cargo_id;
            $agente->admissao        = Carbon::parse( $request->admissao)->format('Y-m-d');
			$agente->matricula		 = $request->matricula;
            $agente->ts              = $request->ts;
            $agente->cnh             = $request->cnh;
            $agente->categoria_cnh   = $request->categoria_cnh;
            $agente->validade_cnh    = Carbon::parse($request->validade_cnh)->format('Y-m-d');
            $agente->municipio       = $request->municipio;
            $agente->bairro          = $request->bairro;
            $agente->logradouro      = $request->logradouro;
            $agente->numero          = $request->numero;
            $agente->complemento     = $request->complemento;
            $agente->cep             = $request->cep;
            $agente->telefone1       = $request->telefone1;
            $agente->telefone2       = $request->telefone2;
            $agente->telefone3       = $request->telefone3;
            $agente->obs             = $request->obs;
            $agente->situacao        = 'PRONTO';
            $agente->altura          = $request->altura;
            $agente->camisa          = $request->camisa;
            $agente->peso            = $request->peso;
            $agente->calca           = $request->calca;
            $agente->sapato          = $request->sapato;
            $agente->tenis           = $request->tenis;
            $agente->coturno         = $request->coturno;
            $agente->colete          = $request->colete;


			if($request->image != null){
				$salva_file = $request->image->store('public/agentes');
				$agente->foto  =  substr($salva_file, 15);
			}

            $agente->save();

        } catch (\Throwable $th) {

			// dd($th->errorInfo);
            return back()->withInput()->with('error', 'Falha ao criar o Agente.'); 
        }
        DB::commit();

        return redirect('agente')->with('sucesso', 'Agente criado com sucesso!');
    }


	public function edit($id)
	{
		$cargos = Cargo::all();
		$agente = Agente::with('cargo')->find($id);

		return view('agente.edit',compact('agente','cargos'));
	}

	public function update(Request $request, $id)
	{
		// dd($request->all());
		$agente = Agente::find($id);
		$agente->nome_servico    = $request->nome_servico;
		$agente->sexo            = $request->sexo;
		$agente->nascimento      = Carbon::parse($request->nascimento)->format('Y-m-d');
		$agente->cargo_id        = $request->cargo_id;
		$agente->admissao        = Carbon::parse( $request->admissao)->format('Y-m-d');
		$agente->matricula		 = $request->matricula;
		$agente->ts              = $request->ts;
		$agente->cnh             = $request->cnh;
		$agente->categoria_cnh   = $request->categoria_cnh;
		$agente->validade_cnh    = Carbon::parse($request->validade_cnh)->format('Y-m-d');
		$agente->municipio       = $request->municipio;
		$agente->bairro          = $request->bairro;
		$agente->logradouro      = $request->logradouro;
		$agente->numero          = $request->numero;
		$agente->complemento     = $request->complemento;
		$agente->cep             = $request->cep;
		$agente->telefone1       = $request->telefone1;
		$agente->telefone2       = $request->telefone2;
		$agente->telefone3       = $request->telefone3;
		$agente->obs             = $request->obs;
		$agente->altura          = $request->altura;
		$agente->camisa          = $request->camisa;
		$agente->peso            = $request->peso;
		$agente->calca           = $request->calca;
		$agente->sapato          = $request->sapato;
		$agente->tenis           = $request->tenis;
		$agente->coturno         = $request->coturno;
		$agente->colete          = $request->colete;

		if($request->image != null){
			$salva_file = $request->image->store('public/agentes');
			$agente->foto  =  substr($salva_file, 15);
		}

		$agente->save();

		$user = User::find($request->user_id);

		$user->name     = $request->nome;
		$user->cpf      = $request->cpf;
		$user->tipo     = $request->tipo;

		$user->save();

		// DB::beginTransaction();
		// try{

		// } catch (\Throwable $th) {

		// }
		// DB::commit();

		return redirect('agente')->with('sucesso', 'Agente Atualizado com sucesso!');
	}

    public function tabela($situacao)
    {
        $logado = Auth::user();

        if($situacao <> "TODOS"){
			$agentes	= Agente::with('usuario')->where('situacao', $situacao)->get();
		}else{
			$agentes	= Agente::with('usuario')->get();
		}

        // Criar o objeto da coleção que será usado para o dataTables
        $colecao = collect();

        // Iterar pelos currículos e montar cada linha da tabela
        $acoes = "";
        foreach($agentes as $agente)
		{
			$acoes = "";
			
			// $btn_capacitacao = "<a href='".url("guarda/capacitacao/$guarda->id")."' "
			// 							." id='btn_capacitacao_guarda'" 
			// 							." class='btn btn-acao2 btn-xs action botao_acao' " 
			// 							." data-toggle='tooltip' data-placement='bottom' " 
			// 							." data-desabilitado = 'false' "
			// 							." data-guarda = $guarda->id"
			// 							." title='Capacitações do Guarda'> "  
			// 							." <i class='fas fas-tabela fa-book'></i></a> ";
										
											
			// $btn_alteracao = "<a href='".url("guarda/alteracao/$guarda->id")."' "
			// 							." id='btn_alteracao_guarda'" 
			// 							." class='btn btn-acao1 btn-xs action botao_acao' " 
			// 							." data-toggle='tooltip' data-placement='bottom' " 
			// 							." data-desabilitado = 'false' "
			// 							." data-guarda = $guarda->id"
			// 							." title='Alterações do Guarda'> "  
			// 							." <i class='glyphicon glyphicon-screenshot'></i></a> ";
									
			$btn_situacao = "<a href='".url("agente/situacao/$agente->id")."' "
										." id='btn_situacao_agente'" 
										." class='btn btn-info btn-xs action botao_acao' " 
										." data-toggle='tooltip' data-placement='bottom' " 
										." data-desabilitado = 'false' "
										." data-agente = $agente->id "
										." title='Alterar Situação do Agente'> "  
										." <i class='glyphicon glyphicon-tags'></i></a> ";
									
									
			// $btn_visualiza	= "<a href='" .url("guarda/$guarda->id")."' " 
			// 						." id='btn_visualiza_guarda' " 
			// 						." class='btn btn-primary btn-xs action botao_acao' " 
			// 						." data-toggle='tooltip' data-placement='bottom' " ;
									
			// 						if( $logado->hasPermissionTo('GERIR RH') ){
			// 							$btn_visualiza = $btn_visualiza ." data-desabilitado = 'false' ";
			// 						}elseif ( $logado->id == $guarda->funcionario_id ) {
			// 							$btn_visualiza = $btn_visualiza ." data-desabilitado = 'false' ";
			// 						}else{
			// 							$btn_visualiza = $btn_visualiza ." data-desabilitado = 'true' disabled ";
			// 						}

			// 						$btn_visualiza = $btn_visualiza ." title='Visializa Guarda'>"  
			// 							." <i class='glyphicon glyphicon-eye-open'></i></a> ";


			$btn_edita	= "<a href='" .url("agente/$agente->id/edit")."' " 
									." id='btn_edita_agente'" 
									." class='btn btn-warning btn-xs action botao_acao' " 
									." data-toggle='tooltip' data-placement='bottom' " ;
									
									// if( $logado->hasPermissionTo('GERIR RH') ){
									// 	$btn_edita = $btn_edita ." data-desabilitado = 'false' ";
									// }elseif ( $logado->id == $agente->funcionario_id ) {
									// 	$btn_edita = $btn_edita ." data-desabilitado = 'false' ";
									// }else{
									// 	$btn_edita = $btn_edita ." data-desabilitado = 'true' disabled ";
									// }

									$btn_edita = $btn_edita ." title='Edita Guarda'> "  
										." <i class='glyphicon glyphicon-pencil'></i></a>";


			// 	$btn_print	= " <a  " 
			// 						." id='btn_print_guarda' " 
			// 						." data-guarda = $guarda->id"
			// 						." class='btn btn-primary btn-xs action botao_acao' " 
			// 						." data-toggle='tooltip' data-placement='bottom' " ;
									
			// 						if( $logado->hasPermissionTo('GERIR RH') ){
			// 							$btn_print = $btn_print ." data-desabilitado = 'false' ";
			// 						}elseif ( $logado->id == $guarda->funcionario_id ) {
			// 							$btn_print = $btn_print ." data-desabilitado = 'false' ";
			// 						}else{
			// 							$btn_print = $btn_print ." data-desabilitado = 'true' disabled ";
			// 						}

			// 						$btn_print = $btn_print ." title='Imprimir Ficha do Guarda'>"  
			// 							." <i class='glyphicon glyphicon-print'></i></a> ";
		
			
			// $acoes = $acoes  .$btn_capacitacao .$btn_alteracao  .$btn_situacao .$btn_visualiza  .$btn_edita .$btn_print;
			$acoes = $acoes  .$btn_edita .$btn_situacao;
			

			if (isset($agente->responsavel )) 
			{
				$resp = $agente->responsavel->nome;
			}else{
				$resp = "---";
			};


			$nome_servico = "<td class='dt-body-left'> $agente->nome_servico";
			if($agente->foto){
				$nome_servico = $nome_servico ."<img src=storage/agentes/$agente->foto style='width: 35px; height: 40px; float: right;'/> </td>"  ;
			}else{
				$nome_servico = $nome_servico ."</td>";
			}

			
			//busca nome serviço dentro de nome
			$pos = strpos( mb_strtoupper($agente->usuario->name, 'UTF-8') , mb_strtoupper($agente->nome_servico, 'UTF-8' )) ;

			if($pos === false){

				$primeiro = current(explode('.',$agente->nome_servico));
				$nome = current(explode(' ',$primeiro));



				$value = $agente->nome_servico;
				$tokens = explode(".", $value);
				//$nome = $tokens[0];

				$nome =  str_ireplace( $tokens[0], "<b><u>" .$tokens[0] ."</u></b>", mb_strtoupper($agente->usuario->name, 'UTF-8' )); 

				if( isset($tokens[1] )){
					$nome = str_ireplace( $tokens[1], "<b><u>" .$tokens[1] ."</u></b>", $nome); 
				}

			}else{
				$nome =  str_ireplace( $agente->nome_servico, "<b><u>" .$agente->nome_servico ."</u></b>", mb_strtoupper($agente->usuario->name, 'UTF-8' )); 	
			}
			
			$colecao->push([
				'nome_servico'			=> $nome_servico,
				'nome'					=> $nome,
				'nascimento'			=> $agente->nascimento,
				'situacao'				=> $agente->situacao,
				'acoes'     			=> $acoes,
			]);
			
		}

		// Retornar a tabela pronta

		return DataTables::of($colecao)
		->rawColumns([ 'nome_servico','acoes','nome'])
		->make(true);
    }
}
