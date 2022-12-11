@extends('gentelella.layouts.app')

@section('content')

<div class="x_panel modal-content">
    <div class="x_title">
       <h2><i class="fas fa-newspaper"></i> Ocorrências </h2>
       <ul class="nav navbar-right panel_toolbox">
        @can('CRIAR OCORRENCIA')
          <a href="{{url('ocorrencia/create')}}" class="btn-circulo btn  btn-success btn-md  pull-right " data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Nova Ocorrência"> Nova Ocorrência </a>
        @endcan
      </ul>
      <div class="clearfix"></div>
    </div>


    <div class="x_panel">
       <div class="x_content">
         <table id="tb_ocorrencia" class="table table-hover table-striped compact">
          <thead>
            <tr>
              <th>Numero</th> 
              <th>Data</th>
              <th>Atendimento</th>
              <th>Setor</th>
              <th>Relato Sucinto</th>
              <th>Agente</th>
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
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
  $(document).ready(function(){
    $('#tb_ocorrencia').DataTable({
      language : {
          'url' : '{{ asset('js/portugues.json') }}',
          "decimal": ",",
          "thousands": "."
      },
          stateSave: false,
          stateDuration: -1,
          responsive: true,
          deferRender: true,
          compact: true,
          processing: true,
          serverSide: true,
          ajax: "{{ url('/ocorrencia/datatables') }}",
          "order": [[ 0, "desc" ]],
          columns: [
              { data : 'sequencia',       name : 'sequencia' },
              { data : 'data',        	name : 'data' },
              { data : 'atendimento',    	name : 'atendimento' },
              { data : 'setor',        	name : 'setor' },
              { data : 'relato',       	name : 'relato' },
              { data : 'agente',        	name : 'agente' },
              { data : 'acoes',        	name : 'acoes' },
          ],
          "columnDefs": [
              { type: 'date-uk', targets: [1] },
              { "width": "10%", "targets": 5 },
              { "width": "10%", "targets": 6 },
              { className: "text-center", "targets": [5] },
              { render: function ( data, type, row ){if( ! data ) {return "";}else{return (moment(data).format("DD/MM/YYYY"));}},targets: [1]},  
              { targets:[0,1], class:"nowrap"},
          ]
      });
  });

  $("table#tb_ocorrencia").on("click", ".btn_enviar",function(){
			
      let id = $(this).data('ocorrencia');
      // console.log(id);
      let btn = $(this);
      //console.log("botao btn_desativa -> ", $(this).data('funcionario'));
      swal({
      title: "Atenção!",
      text: 'Confirma o ENVIO da Ocorrencia?',
      icon: "warning",
      buttons: {
      cancel: {
          text: "Cancelar",
          value: "cancelar",
          visible: true,
          closeModal: true,
      },
      ok: {
          text: "Sim, Enviar!",
          value: 'enviar',
          visible: true,
          closeModal: true,
      }
      }
      }).then(function (resultado) {
          if(resultado === 'enviar'){
      //chama a rota
          $.post('ocorrencia/enviaformulario',{
      _token: 	'{{ csrf_token() }}',
              id: 		id,
          },function(data){
          }).done(function(){
          //Recarregar a página
          location.reload();
          });
      };
  });
});

  $("table#tb_ocorrencia").on("click", ".btn_excluir", function(e){
                  // Evitar que a página seja recarregada	
          e.preventDefault();
                  let id_ocorrencia = $(this).data('ocorrencia');
                  // console.log(id_ocorrencia);
                  swal({
              title: "Atenção!",
              text: 'Confirma a EXCLUSÃO da Ocorrencia?',
              icon: "warning",
              buttons: {
                    cancel: {
                      text: "Cancelar",
                      value: "cancelar",
                      visible: true,
                      closeModal: true,
                    },
                    ok: {
                      text: "Sim, excluir!",
                      value: 'excluir',
                      visible: true,
                      closeModal: true,
                    }
                  }
            }).then(function(resultado){
              if(resultado === 'excluir'){
                // Chamando a url /usuarios/id usando método DELETE e a token de segurança
                      
                      $.post("{{ url("/ocorrencia/") }}/"+id_ocorrencia, {
                        id : id_ocorrencia,
                        _method : "DELETE",
                        _token : "{{ csrf_token() }}",
                      }).done(function(){
                        //Recarregar a página
                        location.reload();
                      });
                  } 
        });
      });

</script>

@endpush