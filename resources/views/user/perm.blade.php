@extends('gentelella.layouts.app')

@section('content')
	<vc_pagina>
		<div class="x_title">
				<h2><i class="fas fa-newspaper"></i> Usuários do TROPA</h2>
				<div class="clearfix"></div>
		</div>

		<div class="x_content">
			<form id="frm_perm" class="form-horizontal form-label-left" method="post" action="{{url("user/perm") }}">
				{!! method_field('PUT') !!}
				{{ csrf_field() }}
				<input type="hidden" id="id" class="form-control " name="id" value="{{$user->id}}">	
			
				<div class="col-md-12 col-sm-12 col-xs-12 ">
					<div class="row">
						<div class="col-md-6  col-sm-6 col-xs-12 ">
								<table class="table table-bordered tabela_compacta">
									<tr>
										<td><b>Nome</b></td>
										<td> {{ $user->name }} </td>
									</tr>
									<tr>
										<td><b>Email</b></td>
										<td> {{ $user->email }} </td>
									</tr>
									<tr>
										<td><b>CPF</b></td>
										<td> {{ $user->cpf }} </td>
									</tr>
								</table>
						</div>
					</div>

					<div class="ln_solid"> </div>

					<div class="form-group row">
						<div class="col-md-6 col-sm-6 col-xs-12" style="border: 1px solid lightgray">
							<H2 style="text-align: center">Roles</H2>
							<div class="ln_solid"> </div>

							<table id="tb_role" class="table table-hover table-striped compact ">
								<thead>
									<tr>
										<th>Roles</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($roles as $key => $role)
										<tr>
											<td class="alinha_centro_vertical">
												<input type="checkbox" class="flat"
													style="position: absolute; opacity: 0;" name="role[{{ $role->name }}]"
													id="role[{{ $role->name }}]" 
													@if( $user->hasRole($role) )
														checked="checked" 
													@endif 
												/>
												{{ $role->name }}
											</td>
										</tr>
									@endforeach
								</tbody>
							</table>
						</div>

						<div class="col-md-6 col-sm-6 col-xs-12" style="border: 1px solid lightgray">
							<H2 style="text-align: center">Permissionamento direto</H2>
							<div class="ln_solid"> </div>

							<table id="tb_perm" class="table table-hover table-striped compact">
								<thead>
									<tr>
										<th>Permissões</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($permissions as $permission)
										<tr>
											<td>
												<input type="checkbox" class="flat"
													style="position: absolute; opacity: 0;"
													name="permission[{{ $permission->name }}]" id="permission[{{ $permission->name }}]"
													@if( $user->hasDirectPermission($permission->id) )
														checked="checked" 
													@endif 
												/>
												{{ $permission->name }}
											</td>
										</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
			
				{{-- BOTÕES --}}

				<div class="clearfix"></div>
				<div class="ln_solid"> </div>
				<div class="footer text-right"> {{-- col-md-3 col-md-offset-9 --}}
                    <input type="submit" hidden>

					<button id="btn_voltar" class="botoes-acao btn btn-round btn-primary">
						<span class="icone-botoes-acao mdi mdi-backburger"></span>
						<span class="texto-botoes-acao"> CANCELAR </span>
						<div class="ripple-container"></div>
					</button>

					<button type="submit" id="btn_salvar" class="botoes-acao btn btn-round btn-success ">
						<span class="icone-botoes-acao mdi mdi-send"></span>
						<span class="texto-botoes-acao"> SALVAR </span>
						<div class="ripple-container"></div>
					</button>
				</div>
			</form>
		</div>			
	</vc_pagina>

@endsection

@push('scripts')
	<script type="text/javascript" src="https://cdn.datatables.net/plug-ins/1.10.20/sorting/date-uk.js"></script>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

	<script>
		$(document).ready(function() {
			var role = $("#tb_role").DataTable({
				language: {
					'url': '{{ asset('js/portugues.json') }}',
					"decimal": ",",
					"thousands": "."
				},
				stateSave: true,
				responsive: true,
				processing: true,
				stateDuration: 60,
				paginate: false,
				order: [
					[0, "asc"]
				],
			});

            var perm = $("#tb_perm").DataTable({
				language: {
					'url': '{{ asset('js/portugues.json') }}',
					"decimal": ",",
					"thousands": "."
				},
				stateSave: true,
				responsive: true,
				processing: true,
				stateDuration: 60,
				paginate: false,
				order: [
					[0, "asc"]
				],
			});


            $("#btn_voltar").click(function(){
				event.preventDefault();
				window.location.href = "{{ URL::route('user.index') }}"; 
			});

        });
	</script>
@endpush
