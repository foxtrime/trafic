@extends('gentelella.layouts.app')


@section('content')

<div class="x_panel modal-content">
    <div class="x_title">
       <h2><i class="fas fa-newspaper"></i> Roles</h2>
       <ul class="nav navbar-right panel_toolbox">
          <a href="{{url('role/create')}}" class="btn-circulo btn  btn-success btn-md  pull-right " data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Nova Sala"> Nova Role </a>
      </ul>
      <div class="clearfix"></div>
    </div>
    <div class="x_panel">
       <div class="x_content">
         <table id="tb_usuario" class="table table-hover table-striped compact">
            <thead>
               <tr>
                  <th>Nome Role</th>
                  <th>Permissões</th>
                  <th>Ações</th>
               </tr>
            </thead>
            <tbody>
                @foreach ($roles as $key=> $role)
                    <tr>
                        <td>{{$role->name}}</td>
                        <td>
                            @foreach($role->permissions as $key=> $perm) 
                                - {{$perm->name}} </br>	
                            @endforeach
                        </td>
                        <td class="actions">
                            <a href="{{url("role/perm/$role->id")}}"  class="btn btn-primary btn-xs action botao_acao" data-toggle="tooltip" data-placement="bottom"
                                id="btn_perm_role" data-role = {{ $role->id }} title="Permissões dessa role"> 
                                <i class="fas fa-shield-alt" style="font-size: 12px !important;padding: 2px !important; "></i>
                            </a>

                            <a href="#" class="btn btn-warning btn-xs action botao_acao" data-toggle="tooltip"  data-placement="bottom" 
                                id="btn_edita_role" data-role = {{ $role->id }} title="Edita essa role">  
                                <i class="glyphicon glyphicon-pencil "></i>
                            </a>

                            <a href="#" class="btn btn-danger btn-xs  action botao_acao" data-toggle="tooltip" data-placement="bottom" 
                                id="btn_exclui_role" data-role = {{ $role->id }} title="Exclui essa role"> 
                                <i class="glyphicon glyphicon-remove "></i>
                            </a>
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