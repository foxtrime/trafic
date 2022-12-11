@extends('gentelella.layouts.app')


@section('content')

<div class="x_panel modal-content">
    <div class="x_title">
       <h2><i class="fas fa-newspaper"></i> Permissões</h2>
       <ul class="nav navbar-right panel_toolbox">
          <a href="{{url('permission/create')}}" class="btn-circulo btn  btn-success btn-md  pull-right " data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Nova Sala"> Nova Permissão </a>
      </ul>
      <div class="clearfix"></div>
    </div>
    <div class="x_panel">
       <div class="x_content">
         <table id="tb_usuario" class="table table-hover table-striped compact">
            <thead>
               <tr>
                  <th>Nome Permissão</th>
                  <th>roles</th>
                  <th>Ações</th>
               </tr>
            </thead>
            <tbody>
                @foreach ($permissions as $key=> $permission)
                  <tr>
                    <td>{{$permission->name}}</td>
                    <td>
                     @foreach($permission->roles as $key=> $role) 
                        - {{$role->name}} </br>	
                     @endforeach
                    </td>
                    <td class="actions">
                        <a href="#" class="btn btn-warning btn-xs action botao_acao" data-toggle="tooltip"  data-placement="bottom" 
                            id="btn_edita_permission" data-permission = {{ $permission->id }} title="Edita essa permissão">  
                            <i class="glyphicon glyphicon-pencil "></i>
                        </a>

                        <a href="#" class="btn btn-danger btn-xs  action botao_acao" data-toggle="tooltip" data-placement="bottom" 
                            id="btn_exclui_permission" data-permission = {{ $permission->id }} title="Exclui essa permissão"> 
                            <i class="glyphicon glyphicon-remove "></i>
                    </td>    
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
            var tb_usuario = $("#tb_usuario").DataTable({
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