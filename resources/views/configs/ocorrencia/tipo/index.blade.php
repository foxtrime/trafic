@extends('gentelella.layouts.app')


@section('content')


<div class="x_panel modal-content">
    <div class="x_title">
       <h2><i class="fas fa-newspaper"></i> Tipo </h2>
       <ul class="nav navbar-right panel_toolbox">
        @can('CONFIG OCORRENCIA')
          <a href="{{url('tipo/create')}}" class="btn-circulo btn  btn-success btn-md  pull-right " data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Nova Sala"> Novo Tipo </a>
        @endcan
      </ul>
      <div class="clearfix"></div>
    </div>
    <div class="x_panel">
       <div class="x_content">
         <table id="tb_tipo" class="table table-hover table-striped compact">
          <thead>
              <tr>
                <th>Nome</th>
                <th>Ações</th>
              </tr>
          </thead>
          <tbody>
            @foreach($nomes as $nome)
            <tr>
              <td>{{$nome->nome}}</td>
              <td></td>
            </tr>
          @endforeach
          </tbody>
        </table>
       </div>
    </div>
 </div>

@endsection

@push('scripts')

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">
  $(document).ready(function(){
             var tb_tipo = $("#tb_tipo").DataTable({
                language: {
                      'url' : '{{ asset('js/portugues.json') }}',
                "decimal": ",",
                "thousands": "."
                },
                stateSave: true,
                stateDuration: -1,
                responsive: true,
             })
          });
   </script>

@endpush