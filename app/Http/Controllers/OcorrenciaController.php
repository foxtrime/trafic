<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\ConfigAtendimento;
use App\Models\ConfigCategoria;
use App\Models\ConfigClima;
use App\Models\ConfigConducao;
use App\Models\ConfigSetor;
use App\Models\ConfigTipo;
use App\Models\ConfigTransportado;
use App\Models\Agente;
use App\Models\Ocorrencia;
use App\Models\Ocorrencia_Images;
use App\Models\Ocorrencia_Categorias;
use App\Models\Ocorrencia_Agentes;
use App\Models\Sequencia;

use Carbon\Carbon;
use DataTables;
use Auth;

class OcorrenciaController extends Controller
{
   
   
    public function index()
    {

        return view('ocorrencia.index');
    }

    public function create()
    {

        $agentes = Agente::with('usuario')->where('user_id','!=', Auth::user()->id)->get();

        $atendimentos = ConfigAtendimento::all();
        $categorias = ConfigCategoria::all();
        $climas = ConfigClima::all();
        $conducoes = ConfigConducao::all();
        $setores = ConfigSetor::all();
        $tipos = ConfigTipo::all();
        $transportados = ConfigTransportado::all();
        
        return view('ocorrencia.create', compact('atendimentos','categorias','climas','conducoes','setores','tipos','transportados','agentes'));
    }

    public function store(Request $request)
    {
        // PEGA O ARRAY DE AGENTES
        $agente_arr = $request->agentes_id;

        $ocorrencia = new Ocorrencia;

        $ocorrencia->data               = Carbon::parse($request->data)->format('Y-m-d');
        $ocorrencia->hora               = $request->hora;
        $ocorrencia->atendimento_id     = $request->atendimento_id;
        $ocorrencia->tipo_id            = $request->tipo_id;
        $ocorrencia->clima_id           = $request->clima_id;
        $ocorrencia->transportado_id    = $request->transportado_id;
        $ocorrencia->conducao_id        = $request->conducao_id;
        $ocorrencia->setor_id           = $request->setor_id;
        $ocorrencia->cep                = $request->cep;
        $ocorrencia->bairro             = $request->bairro;
        $ocorrencia->logradouro         = $request->logradouro;
        $ocorrencia->numero             = $request->numero;
        $ocorrencia->complemento        = $request->complemento;
        $ocorrencia->envolvidos         = $request->envolvidos;
        $ocorrencia->relato             = $request->relato;
        $ocorrencia->providencia        = $request->providencia;
        

        $ocorrencia->sequencia          = 'XXX';

        $ocorrencia->fill($request->all());

        $ocorrencia->save();

        if(isset($request->categoria_id)){
            foreach($request->categoria_id as $categoria_id)
            {
                $categoria = new Ocorrencia_Categorias;
                
                $categoria->ocorrencia_id   = $ocorrencia->id;
                $categoria->categoria_id    = $categoria_id;

                $categoria->save();
            }
        }
      
        if(isset($request->imagens)){
            $imagens_ids = [];

            foreach($request->imagens as $imagem){
               if($imagem !== null) {
                  $img = Ocorrencia_Images::create([
                     'ocorrencia_id' => $ocorrencia->id,
                     'image'      => $imagem
                  ]);
                  $imagens_ids[] = $img->id;
               }
            }
        }

        foreach($request->input('imagens', []) as $file){
            $pasta_tmp = storage_path('app/public/ocorrencia/tmp/'.$file);

            $pasta_definitiva = storage_path('app/public/ocorrencia/'.$file);

            rename($pasta_tmp, $pasta_definitiva);
         }

         // SALVA O CARA QUE É O RELATOR
		DB::table('ocorrencias_agentes')->insert(
			['agente_id' => agenteLogado()->id ,'relator' => true,'ocorrencia_id' => $ocorrencia->id]
		);

		// SALVA QUE NÃO É O RELATOR
		foreach($agente_arr as $key => $agente){
			DB::table('ocorrencias_agentes')->insert(
				['agente_id' => $agente ,'relator' => false,'ocorrencia_id' => $ocorrencia->id]
			);
		}

         return redirect()->route('ocorrencia.index');

    
    }

    public function show($id)
    {
        $ocorrencia = Ocorrencia::with('imagens')->find($id);

        return view('ocorrencia.show',compact('ocorrencia'));
    }

    public function destroy($id)
	{
		
		$ocorrencia = Ocorrencia::with('imagens')->find($id);
	
		foreach($ocorrencia->imagens as $image)
		{   
			$img = Ocorrencia_Images::find($image->id);
			$img->delete();
			// APAGAR TAMBEM A IMAGEM QUE FICA NA STORAGE
			unlink( storage_path('app/public/ocorrencia/'.$img->image) );
		}
        
        $ocorrencia->delete();

		return redirect(url('/ocorrencia'));

	}

    public function deleteimg ($id){

        $imagem = Ocorrencia_Images::find($id);
  
        unlink(storage_path('app/public/ocorrencia/'.$imagem->image));
  
        $imagem->delete();
  
        return "IMAGEM DELETADA";
     }

     public function storeImage(Request $request){

        $path = storage_path('app/public/ocorrencia/tmp');
  
        if(!file_exists($path)) {
           mkdir($path, 007, true);
        }
  
        $file = $request->file('file');
  
        $name = uniqid(). '_' . trim($file->getClientOriginalName());
  
        $file->move($path, $name);
  
        return response()->json([
           'name' => $name,
           'original_name' => $file->getClientOriginalName(),
        ]);
     }

     public function envia(Request $request)
     {
        $sqc = Sequencia::first();
		$sequencia_ocorrencia = $sqc->numero_ocorrencia;

		$ocorrencia = Ocorrencia::find($request->id);
		$ocorrencia->enviado = 1;
		$ocorrencia->sequencia = "SETRANS.".date("Y").".".$sequencia_ocorrencia;

		$ocorrencia->save();

		$sequencia_ocorrencia++;

		$sqc->fill(['numero_ocorrencia' => $sequencia_ocorrencia] );

		$sqc->save();
     }

     public function dados()
     {

        $gerir_ocorrencia = Auth::user()->can("GERIR OCORRENCIA");
        $criar_ocorrencia = Auth::user()->can("CRIAR OCORRENCIA");
        $array_ocorrencias = [];
        
        if($gerir_ocorrencia && $criar_ocorrencia){

            $ocorrencias 				= Ocorrencia::with('agentes')->where('enviado',1)->get();
			$ocorrencias_agente 		= Ocorrencia_Agentes::where('agente_id',Auth::user()->agente->id)->get();
		
			foreach($ocorrencias as $ocorrencia){
				array_push($array_ocorrencias, $ocorrencia);
			}

			foreach($ocorrencias_agente as $ocorrencia_agente){
				$occorencias_onde_citado = Ocorrencia::with('agentes')->find($ocorrencia_agente->ocorrencia_id);
				array_push($array_ocorrencias,$occorencias_onde_citado);
			} 
		
			$array_ocorrencias = array_unique($array_ocorrencias);

        }elseif($criar_ocorrencia){

            $ocorrencias_agente = Ocorrencia_Agentes::where('agente_id',Auth::user()->agente->id)->get();

            foreach($ocorrencias_agente as $ocorrencia_agente)
            {
                $ocorrencias_citado = Ocorrencia::with('agentes')->find($ocorrencia_agente->ocorrencia_id);
                array_push($array_ocorrencias,$ocorrencias_citado);
            }

        }else{
            $ocorrencias = Ocorrencia::with('agentes')->where('enviado',1)->get();

            foreach($ocorrencias as $ocorrencia)
            {
                array_push($array_ocorrencias, $ocorrencia);
            }
        }


        $colecao = collect();

        foreach($array_ocorrencias as $ocorrencia)
        {
            $acoes = "";

            if(!$ocorrencia->enviado)
            {
                foreach($ocorrencia->agentes as $key => $agente){
                    if($agente->pivot->relator){
                        $relator = $agente->id;
                    }
                }
    
                if(Auth::user()->agente->id == $relator)
                {
                    $acoes .= "
                        <td style='width: 16%;'>
                            <a class='btn btn-success btn-xs action botao_acao btn_enviar' style='margin-right: 2px;'
                                data-ocorrencia='".$ocorrencia->id."' data-toggle='tooltip'
                                data-placement='bottom' title='Enviar Ocorrencia'>
                                <i class='glyphicon glyphicon-ok'></i>
                            </a>
    
                            <a href='".url("ocorrencia/$ocorrencia->id/edit")."' 
                                class='btn btn-warning btn-xs action botao_acao btn_editar'
                                data-toggle='tooltip' data-placement='bottom' title='Editar Ocorrencia'>
                                <i class='glyphicon glyphicon-pencil '></i>
                            </a>
    
                            <a id='btn_exclui_guarda'
                                class='btn btn-danger btn-xs action botao_acao btn_excluir'
                                data-toggle='tooltip' data-ocorrencia='".$ocorrencia->id."'
                                data-placement='bottom' title='Excluir Ocorrencia'>
                                <i class='glyphicon glyphicon-trash'></i>
                            </a>
                        </td>
                    ";
                }

            }
            $acoes .= "<td style='width: 16%;'>
				    <a href='".url("/ocorrencia/$ocorrencia->id")."' 
				        class='btn btn-primary btn-xs action botao_acao btn_vizualizar'
				        data-toggle='tooltip' data-placement='bottom' title='Vizualizar Ocorrencia'>
				        <i class='glyphicon glyphicon-eye-open'></i>
                    </a>
				    
				    <a href='".$ocorrencia->id."' 
				        class='btn btn-info btn-xs action botao_acao btn_imprimir'
				        data-toggle='tooltip' data-placement='bottom' title='Imprimir Ocorrencia'>
				        <i class='glyphicon glyphicon-print'></i>
				    </a>              
			    </td>";

            
            

            $agente = $ocorrencia->agentes()->where("relator",true)->first();


            $colecao->push([

                'sequencia'     => $ocorrencia->sequencia,
                'data'          => $ocorrencia->data,
                'atendimento'   => $ocorrencia->atendimento->nome,
                'setor'         => $ocorrencia->setor->nome,
                'relato'        => mb_strimwidth($ocorrencia->relato, 0, 70,"..."),
                'agente'        => $agente->nome_servico,
                'acoes'         => $acoes

            ]);
        }
        
        return DataTables::of($colecao)->rawColumns(['acoes'])->make(true);

     }
  
}
