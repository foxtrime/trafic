@extends('gentelella.layouts.app')
@section('htmlheader_title', 'Home')
@section('content')

	<link href="{{ asset('css/tom-select.bootstrap5.min.css') }}" rel="stylesheet" />
	<link rel="stylesheet" href="{{ asset('css/dropzone.min.css')}}">

    <div class="x_panel modal-content">
		<div class="x_title">
			<h2><i class="fas fa-user-shield"></i> Nova Ocorrência</h2>
			<div class="clearfix"></div>
		</div>

		<div class="x_panel ">
			<div class="x_content">
				<form id="frm_ocorrencia" class="form-horizontal form-label-left" method="post" enctype="multipart/form-data" action="{{ route('ocorrencia.store') }}">
					{{ csrf_field()}} 

					<div class="row">
						<div class="form-group col-md-12 col-sm-12 col-xs-12">
							<label class="control-label">Atendimento</label>
							{{-- <input type="text" id="nome" class="form-control" placeholder="Nome" name="nome" minlength="4" maxlength="100"
						   required>	 --}}
						   	<select name="atendimento_id" id="atendimento_id" class="form-control" required>
								<option value="">Selecione o Atendimento</option>  
								@foreach ($atendimentos as $atendimento)
									<option value="{{$atendimento->id}}">{{$atendimento->nome}}</option> 
								@endforeach
							</select>
					 	</div>
					</div>

					<div class="row">
				 		<div class="form-group col-md-3 col-sm-3 col-xs-12">
                 		       <label class="control-label">Data</label>
                 		       <input type="date" id="data" class="form-control" placeholder="data" name="data" minlength="4" maxlength="100" value="{{$data_atual}}" required >	
                 		</div>

						<div class="form-group col-md-3 col-sm-3 col-xs-12"></div>

						<div class="form-group col-md-3 col-sm-3 col-xs-12 col-md-offset-3 col-sm-offset-3">
							<label class="control-label">Hora</label>
							<input type="time" id="hora" class="form-control" placeholder="hora" name="hora" minlength="4" maxlength="100" value="{{$hora_atual}}"
						   required >	
			 			</div>
					</div>

					<div class="row">
						<div class="form-group col-md-4 col-sm-4 col-xs-12">
							<label class="control-label">Tipo</label>
							{{-- <input type="text" id="nome" class="form-control" placeholder="Nome" name="nome" minlength="4" maxlength="100"
						required >	 --}}
							<select name="tipo_id" id="tipo_id" class="form-control">
								<option value="">Selecione o Tipo</option>  
								@foreach ($tipos as $tipo)
									<option value="{{$tipo->id}}">{{$tipo->nome}}</option> 
								@endforeach
							</select>
						</div>

						<div class="form-group col-md-4 col-sm-4 col-xs-12">
							<label class="control-label">Clima</label>
							{{-- <input type="text" id="nome" class="form-control" placeholder="Nome" name="nome" minlength="4" maxlength="100"
						required >	 --}}
							<select name="clima_id" id="clima_id" class="form-control">
								<option value="">Selecione o Clima</option>  
								@foreach ($climas as $clima)
									<option value="{{$clima->id}}">{{$clima->nome}}</option> 
								@endforeach
							</select>
						</div>

						<div class="form-group col-md-4 col-sm-4 col-xs-12">
							<label class="control-label">Transportado</label>
							{{-- <input type="text" id="nome" class="form-control" placeholder="Nome" name="nome" minlength="4" maxlength="100"
						required >	 --}}
							<select name="transportado_id" id="transportado_id" class="form-control">
								<option value="">Selecione o Transportado</option>  
								@foreach ($transportados as $transportado)
									<option value="{{$transportado->id}}">{{$transportado->nome}}</option> 
								@endforeach
							</select>
						</div>
					</div>

					<div class="row">
						 <div class="form-group col-md-6 col-sm-6 col-xs-12">
							<label class="control-label">Condução da Vitima</label>
							{{-- <input type="text" id="nome" class="form-control" placeholder="Nome" name="nome" minlength="4" maxlength="100"
						   required >	 --}}
							<select name="conducao_id" id="conducao_id" class="form-control">
								<option value="">Selecione a Condução</option>  
								@foreach ($conducoes as $conducao)
									<option value="{{$conducao->id}}">{{$conducao->nome}}</option> 
								@endforeach
							</select>
			 			</div>

						 <div class="form-group col-md-6 col-sm-6 col-xs-12">
							<label class="control-label">Setor</label>
							{{-- <input type="text" id="nome" class="form-control" placeholder="Nome" name="nome" minlength="4" maxlength="100"
						   required >	 --}}
						   	<select name="setor_id" id="setor_id" class="form-control" required>
								<option value="">Selecione o Setor</option>  
								@foreach ($setores as $setor)
									<option value="{{$setor->id}}">{{$setor->nome}}</option> 
								@endforeach
							</select>
			 			</div>
					</div>

					<input type="text" name="latitude" id="latitude" hidden>
					<input type="text" name="longitude" id="longitude" hidden>
					<input type="text" name="municipio" id="municipio" hidden>

					<div class="row">
						
						<div class="form-group col-md-2 col-sm-2 col-xs-12">
							<p><b>Para pegar sua localização atual.</b></p>
							{{-- <button type="button" onclick="getLocation()">Clique Aqui!</button> --}}

							<button type="button" onclick="getLocation()" class="botoes-acao btn btn-round btn-primary" style="padding: 1px 12px !important;width: 100% " >
								<span class="icone-botoes-acao mdi mdi-backburger"></span>   
								<span class="texto-botoes-acao"> Clique Aqui! </span>
								<div class="ripple-container"></div>
							</button>
						</div>

						 <div class="form-group col-md-4 col-sm-4 col-xs-12">
							<label class="control-label">CEP</label>
							<input type="text" id="cep" class="form-control" placeholder="CEP" name="cep" minlength="4" maxlength="100">	
			 			</div>

						 <div class="form-group col-md-6 col-sm-6 col-xs-12">
							<label class="control-label">Bairro</label>
							<input type="text" id="bairro" class="form-control" placeholder="Bairro" name="bairro" minlength="4" maxlength="100"
						    >	
			 			</div>
					</div>
					<div class="row">
						 <div class="form-group col-md-8 col-sm-8 col-xs-12">
							<label class="control-label">Logradouro</label>
							<input type="text" id="logradouro" class="form-control" placeholder="Logradouro" name="logradouro" minlength="4" maxlength="100"
						    >	
			 			</div>

						 <div class="form-group col-md-2 col-sm-2 col-xs-12">
							<label class="control-label">Numero</label>
							<input type="text" id="numero" class="form-control" placeholder="Numero" name="numero" minlength="4" maxlength="100"
						    >	
			 			</div>

						 <div class="form-group col-md-2 col-sm-2 col-xs-12">
							<label class="control-label">Complemento</label>
							<input type="text" id="complemento" class="form-control" placeholder="Complemento" name="complemento" minlength="4" maxlength="100"
						    >	
			 			</div>
					</div>

					<div class="row">
						 <div class="form-group col-md-12 col-sm-12 col-xs-12">
							<label class="control-label">Categoria</label>
							{{-- <input type="text" id="nome" class="form-control" placeholder="Nome" name="nome" minlength="4" maxlength="100"
						   required >	 --}}
						   	<select name="categoria_id[]" id="categoria_id" multiple class="form-control" required>
								<option value="">Selecione a Categoria(s)</option>  
								@foreach ($categorias as $categoria)
									<option value="{{$categoria->id}}">{{$categoria->nome}}</option> 
								@endforeach
							</select>
			 			</div>
					
						 
						 <div class="row">
							<div class="form-group col-md-12 col-sm-12 col-xs-12">
								<label class="control-label" for="envolvidos">Envolvidos</label>
								<textarea name="envolvidos" id="envolvidos" type="text" class="form-control" rows="3" required></textarea>
							</div>
						</div>
						

						<div class="row">
							<div class="form-group col-md-12 col-sm-12 col-xs-12">
								<label class="control-label" for="relato">Relato Sucinto</label>
								<textarea name="relato" id="relato" type="text" class="form-control" rows="3" required></textarea>
							</div>
						</div>

						<div class="row">
							<div class="form-group col-md-12 col-sm-12 col-xs-12">
								<label class="control-label" for="providencia">Providências Adotadas</label>
								<textarea name="providencia" id="providencia" type="text" class="form-control" rows="3" required></textarea>
							</div>
						</div>

						<!-- =============  ADICIONAR OUTROS FUNCIONARIOS NO RELATORIO  ========= -->
						<div class="row">
							<div class=" form-group col-md-12 col-sm-12 col-xs-12">
								<label class="control-label" >Adicionar Integrantes na Ocorrência</label>
								<select name="agentes_id[]" id="agentes_id" multiple class="form-control" required>
									<option value="">Adicionar agente</option>  
									@foreach ($agentes as $agente)
										<option value="{{$agente->id}}"> {{$agente->nome_servico}} - {{$agente->usuario->name}} </option> 
									@endforeach
								</select>
							</div>
						</div>
						<!-- ===========  FIM ADICIONAR OUTROS FUNCIONARIOS NO RELATORIO  ========== -->

						<!-- =============================   IMAGEM   ============================== -->
						<div class="form-group">
							<label for="document">Imagens</label>
							<div class="needsclick dropzone" id="document-dropzone">
					
							</div>
						</div>
						<!-- ==========================   FIM IMAGEM   ============================= -->


					 {{-- 
					 <div class="form-group col-md-12 col-sm-12 col-xs-12">
						<label class="control-label">Imagens</label>
						<input type="text" id="nome" class="form-control" placeholder="Nome" name="nome" minlength="4" maxlength="100"
					   required >	
			 		</div> --}}

					</div>
					
					
				
					{{-- BOTÕES --}}
					<div class="clearfix"></div>
					<div class="ln_solid"> </div>
						<div class="footer text-right"> {{-- col-md-3 col-md-offset-9 --}}
                            <input type="submit" hidden> {{-- INPUT HIDDEN PARA DEIXAR O BTN NA ORDEM DE SALVAR NA DIREITA --}}
                            
							<button id="btn_cancelar" class="botoes-acao btn btn-round btn-primary" >
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
		</div>
    </div>
		
@endsection

@push("scripts")
	<script src="{{ asset('js/tom-select.complete.min.js') }}"></script>
	<script src="{{ asset('js/dropzone.min.js')}}"></script>
	<script src="https://maps.googleapis.com/maps/api/js?key={{$key_maps}}" defer></script>

	<script>
		var x = document.getElementById("demo");
		
		function getLocation() {
		  if (navigator.geolocation) {
			navigator.geolocation.getCurrentPosition(showPosition);
		  } else { 
			x.innerHTML = "Geolocation is not supported by this browser.";
		  }
		}
		
		function showPosition(position) {
			
		document.querySelector("[name='latitude']").value = position.coords.latitude;
		document.querySelector("[name='longitude']").value = position.coords.longitude;
		
		const geocoder = new google.maps.Geocoder();

		const latlng = {
			lat: position.coords.latitude,
			// lat: -22.7828677,
			lng: position.coords.longitude,
			// lng: -43.4317243,
		}

		geocoder.geocode({location: latlng}).then((response) => {
			if(response.results[0]){

				// alert(response.results[0].formatted_address);
				console.log(response.results[0].address_components);

				for(let valor of response.results[0].address_components){
					if(valor.types[0] === 'street_number'){

						document.querySelector("[name='numero']").value = valor.long_name;

					}else if (valor.types[0] === 'route') {

						document.querySelector("[name='logradouro']").value = valor.long_name;

					}else if (valor.types[0] === 'political') {

						document.querySelector("[name='bairro']").value = valor.long_name;

					}else if (valor.types[0] === 'administrative_area_level_2') {

						// municipio
						document.querySelector("[name='municipio']").value = valor.long_name;


					}else if(valor.types[0] === 'postal_code'){
						
						document.querySelector("[name='cep']").value = valor.long_name;

					}
				}


			}
		})
		}
	</script>



	<script type="text/javascript">
		$(document).ready(function(){
			//botão de voltar
			$("#btn_cancelar").click(function(){
				event.preventDefault();
				window.location.href = "{{ URL::route('ocorrencia.index') }}"; 
			});
		});

		var uploadedDocumentMap = {}
		Dropzone.options.documentDropzone = {
		    url: '{{ route('ocorrencia.storeImage') }}',
		    maxFilesize: 5, // MB
		    addRemoveLinks: true,
		    headers: {
		    	'X-CSRF-TOKEN': "{{ csrf_token() }}"
		    },
		    success: function (file, response) {
		    	$('form').append('<input type="hidden" name="imagens[]" value="' + response.name + '">')
		    	uploadedDocumentMap[file.name] = response.name
		    },
		    removedfile: function (file) {
		    	file.previewElement.remove()
		    	var name = ''
		    	if (typeof file.file_name !== 'undefined') {
		    	name = file.file_name
		    	} else {
		    	name = uploadedDocumentMap[file.name]
		    	}
		    	$('form').find('input[name="imagens[]"][value="' + name + '"]').remove()
				
                // console.log(name)
		    },
		    init: function () {
		    	@if(isset($project) && $project->document)
		    	var files =
		    		{!! json_encode($project->document) !!}
		    	for (var i in files) {
		    		var file = files[i]
		    		this.options.addedfile.call(this, file)
		    		file.previewElement.classList.add('dz-complete')
		    		$('form').append('<input type="hidden" name="imagens[]" value="' + file.file_name + '">')
		    	}
		    	@endif
		    }
		}

	</script>
	<script type="text/javascript">
		 new TomSelect('#categoria_id',{
			maxOptions: 150,
			sortField: {
				field: 'text',
				direction: 'asc'
		    }
        });

		new TomSelect('#agentes_id',{
			maxOptions: 150,
			sortField: {
				field: 'text',
				direction: 'asc'
		    }
        });

		
	</script>
@endpush


