@extends('gentelella.layouts.app')


@section('content')


<div class="x_panel modal-content">
    <div class="x_title">
       <h2><i class="fas fa-newspaper"></i> Cargos </h2>
       <ul class="nav navbar-right panel_toolbox">
        @can('CONFIG CARGO')
          <a href="{{url('cargo/create')}}" class="btn-circulo btn  btn-success btn-md  pull-right " data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Nova Sala"> Novo Cargo </a>
        @endcan
      </ul>
      <div class="clearfix"></div>
    </div>
    <div class="x_panel">
       <div class="x_content">
         <table id="tb_cargo" class="table table-hover table-striped compact">
          <thead>
              <tr>
                <th>Cargo</th>
                <th>Ações</th>
              </tr>
          </thead>
          <tbody>
            @foreach($cargos as $cargo)
              <tr>
                <td>{{$cargo->cargo}}</td>
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
             var tb_cargo = $("#tb_cargo").DataTable({
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