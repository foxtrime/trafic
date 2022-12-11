@extends('gentelella.layouts.app')


@section('content')


<div class="x_panel modal-content">
    <div class="x_title">
       <h2><i class="fas fa-newspaper"></i> Usuarios</h2>
       <ul class="nav navbar-right panel_toolbox">
          <a href="{{url('user/create')}}" class="btn-circulo btn  btn-success btn-md  pull-right " data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Nova Sala"> Novo(a) Usuario </a>
      </ul>
      <div class="clearfix"></div>
    </div>
    <div class="x_panel">
       <div class="x_content">
         <table id="tb_usuario" class="table table-hover table-striped compact">
           


            <thead>
               <tr>
                  <th>Nome</th>
                  <th>Email</th>
                  <th>Roles</th>
                  <th>Permissões Diretas</th>
                  <th>Ações</th>
               </tr>
            </thead>
            <tbody>
               @foreach ($users as $user)
                  <tr>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>
                        @foreach($user->roles as $key=> $rol) 
                           - {{$rol->name}} </br>	
                        @endforeach
                     </td>
                    <td>
                        @foreach($user->permissions as $key=> $perm) 
									- {{$perm->name}} </br>	
								@endforeach
                    </td>
                    <td class="actions">
                        <a href="{{ url("user/perm/$user->id") }}"  class="btn btn-info btn-xs action botao_acao" data-toggle="tooltip" data-placement="bottom"
                            id="btn_permissao_user" data-user = {{ $user->id }} title="Permissões desse Usuário"> 
                            <i class="fas fa-shield-alt" style="font-size: 12px !important;padding: 2px !important; "></i>
                        </a>

                        <a href="{{ url("user/$user->id/edit") }}" class="btn btn-warning btn-xs action botao_acao" data-toggle="tooltip"  data-placement="bottom" 
                            id="btn_edita_user" data-user = {{ $user->id }} title="Edita esse Usuário">  
                            <i class="glyphicon glyphicon-pencil "></i>
                        </a>
                        
                        <a href="#" class="btn btn-danger btn-xs  action botao_acao" data-toggle="tooltip" data-placement="bottom" 
                            id="btn_exclui_user" data-user = {{ $user->id }} title="Exclui esse Usuário"> 
                            <i class="glyphicon glyphicon-remove "></i>
                        </a>

                        <a class="btn btn-info btn-xs action  botao_acao" data-toggle="tooltip" data-placement="bottom"
                            id="btn_nova_senha" data-user = {{$user->id}} title="Envia NOVA senha por email ao Usuário">
                            <i class="glyphicon glyphicon-envelope "></i>
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