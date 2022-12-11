@extends('gentelella.layouts.app')


@section('content')


<div class="x_panel modal-content">
    <div class="x_title">
       <h2><i class="fas fa-newspaper"></i> Agentes </h2>
       <ul class="nav navbar-right panel_toolbox">
        @can('GERIR AGENTE')
          <a href="{{url('agente/create')}}" class="btn-circulo btn  btn-success btn-md  pull-right " data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Nova Sala"> Novo(a) Agente </a>
        @endcan
      </ul>
      <div class="clearfix"></div>
    </div>

    <div class="x_panel">
      <label class="col-md-2 col-sm-2 col-xs-12" for="selecao" style="margin-top: 5px;" >Situação</label>
      <div class="col-md-10 col-sm-10 col-xs-12">
        <select name="selecao" id="selecao" class="form-control">
          <option value="TODOS">TODOS</option>
          @foreach($situacoes as $situacao)
            @if($filtro_situacao == $situacao->nome)
              <option value="{{$situacao->nome}}" selected> {{$situacao->nome}} - {{$situacao->total}} </option>
            @else
              <option value="{{$situacao->nome}}"> {{$situacao->nome}} - {{$situacao->total}} </option>
            @endif
          @endforeach
          
        </select>	
      </div>	
    </div>

    <div class="x_panel">
       <div class="x_content">
         <table id="tb_agente" class="table table-hover table-striped compact">
          <thead>
            <tr>
              <th>Nome de Serviço</th> 
              <th>Nome</th>
              <th>Nascimento</th>
              <th>Situação</th>
              <th>Ações</th>
            </tr>						
          </thead>
  
          <tbody>
      
          </tbody>

        </table>
       </div>
    </div>
 </div>

@endsection

@push('scripts')

  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/plug-ins/1.10.20/sorting/date-uk.js"></script>

  <script>
    $.fn.dataTable.moment( 'DD/MM/YYYY' );
    var tabela_agentes = $("#tb_agente").DataTable({
      language : {'url' : '{{ asset('js/portugues.json') }}',"decimal": ",","thousands": "."}, 
      stateSave: true, stateDuration: -1, responsive: true, serverSide: true,
      ajax      : "{{url('/agente/tabela')}}" + "/" + $("select#selecao").val(),
      columns   : [
					{ data : 'nome_servico',    			name : 'nome_servico' },
					{ data : 'nome',    						name : 'nome' },
					{ data : 'nascimento',    				name : 'nascimento' },
					{ data : 'situacao',						name : 'situacao' },
					{ data : 'acoes', 						name : 'acoes' },
				],
        columnDefs: [
					{ type: 'date-uk', targets: [2] },
					{ 
						render: function ( data, type, row )             
						{
							if( ! data ) {
								return "";
							}else{
								return (moment(data).format("DD/MM/YYYY"));
							}
						}, targets: [2]
					},  
					{ responsivePriority: -1, 		targets: 0 },
					{ responsivePriority: 10, 		targets: 1 },
					{ responsivePriority: 10,		targets: 2 },
					{ responsivePriority: 10, 		targets: 3 },
					{ responsivePriority: -1, 		targets: 4 },
				]
    });

    //seleção de situação
			$("select#selecao").change(function() {
				tabela_agentes.ajax.url("{{url('/agente/tabela')}}"  +"/" +$("select#selecao").val()).load();
			});
  </script>

@endpush