@extends('gentelella.layouts.app')
@section('htmlheader_title', 'Home')
@section('content')

<link rel="stylesheet" href="{{ asset('css/filepreview.css') }}">

    <div class="x_panel modal-content">
		<div class="x_title">
			<h2><i class="fas fa-user-shield"></i> Novo Agente </h2>
			<div class="clearfix"></div>
		</div>

		<div class="x_panel ">
			<div class="x_content">
				<form id="frm_guarda" class="form-horizontal form-label-left" method="post" enctype="multipart/form-data" action="{{ route('agente.store') }}">
					{{ csrf_field()}} 

					<div id="desabilita">
						<div class="form-group row">
							<div class="col-md-3 col-sm-3" style="float: left!important">
								<div class="wrapper">
								   <div class="image">
									  <img class="img" >
								   </div>
								   <div class="content">
									  <div class="icon" style="padding-left: 45%;">
										 <i class="fas fa-cloud-upload-alt"></i>
									  </div>
									  <div class="text" style="padding-bottom: 70px;">
										Nenhum Arquivo Selecionado
									  </div>
								   </div>
								   <div id="cancel-btn">
									  <i class="fas fa-times"></i>
								   </div>
								   <div class="file-name">
									  File name here
								   </div>
								</div>
								<button onclick="defaultBtnActive()" id="custom-btn">Escolha uma Imagem</button>
								<input id="default-btn" name="image" type="file" style="display: none" hidden>
							</div>
							
							
							<div class=" form-group col-md-9 col-sm-9 col-xs-12">
								<label class="control-label" >Nome</label>
								<input type="text" id="nome" class="form-control " name="nome" minlength="4" maxlength="100" required >	
							</div>
			

							<div class=" form-group col-md-4 col-sm-4 col-xs-12">
								<label class="control-label" >Nome de Serviço</label>
								<input type="text" id="nome_servico" class="form-control " name="nome_servico" minlength="4" maxlength="100" required >	
							</div>
							
							<div class="form-group col-md-2 col-sm-2 col-xs-12 ">
								<label class="control-label" for="admissao">Admissão</label>
								<input type="text" id="admissao" 	class="form-control datas_input" name="admissao" v-mask="'##/##/####'">
							</div>

							<div class="form-group col-md-3 col-sm-3 col-xs-12 ">
								<label class="control-label" for="matricula">Matrícula</label>
								<input type="matricula" id="matricula" class="form-control" name="matricula">	
							</div>
							
							<div class="form-group col-md-2 col-sm-2 col-xs-12 ">
								<label class="control-label" for="nascimento">Nascimento</label>
								<input type="text" id="nascimento" 	class="form-control datas_input" name="nascimento" v-mask="'##/##/####'">
							</div>

							<div class="form-group col-md-2 col-sm-2 col-xs-12">
								<label class="control-label" for="sexo">Sexo</label>
								<select name = "sexo" id="sexo" class="form-control  selectpicker error" 
									data-style="select-with-transition has-dourado" required >
									<option value=""></option>
                                    <option value="Masculino"> Masculino </option>
                                    <option value="Feminino"> Feminino </option>
								</select>
							</div>

							<div class="form-group col-md-2 col-sm-2 col-xs-12">
								<label class="control-label" for="ts">Tipo Sang.</label>
								<select name = "ts" id="ts" class="form-control  selectpicker error" 
									data-style="select-with-transition has-dourado"  >
									<option value=""></option>
									    
                                    <option value="A+"> A+ </option>
                                    <option value="A-"> A- </option>
                                    <option value="AB+"> AB+ </option>
                                    <option value="AB-"> AB- </option>
                                    <option value="B+"> B+ </option>
                                    <option value="B-"> B- </option>
                                    <option value="O+"> O+ </option>
                                    <option value="O-"> O- </option>
								</select>
							</div>

							<div class="form-group col-md-2 col-sm-2 col-xs-12">
								<label class="control-label" for="tipo">Tipo</label>
								<select name="tipo" id="tipo" class="form-control  selectpicker error" 
									data-style="select-with-transition has-dourado" required >
									<option value=""></option>
                                    <option value="Efetivo"> Efetivo </option>
                                    <option value="Comissionado"> Comissionado </option>
                                    <option value="Externo"> Externo </option>
								</select>
							</div>

						</div>
						
						<div class="form-group row">
							<div class="form-group col-md-3 col-sm-3 col-xs-12 ">
								<label class="control-label" for="cpf">CPF</label>
									<input type="cpf" id="cpf" class="form-control" name="cpf" required>	
							</div>
							
							<div class="form-group col-md-6 col-sm-6 col-xs-12 ">
								<label class="control-label" for="email">Email</label>
								<input type="email" id="email" class="form-control" name="email" required>	
							</div>
						</div>

						<div class="form-group row">
							<div class="form-group col-md-3 col-sm-3 col-xs-12 ">
								<label class="control-label" for="cnh">CNH</label>
								<input type="cnh" id="cnh" class="form-control" name="cnh" maxlength="11">	
							</div>

							<div class="form-group col-md-2 col-sm-2 col-xs-12">
								<label class="control-label" for="categoria_cnh">Cat. CNH</label>
								<select name = "categoria_cnh" id="categoria_cnh" class="form-control  selectpicker error" 
									data-style="select-with-transition has-dourado"  >
									<option value=""></option>
                                    <option value="A"> A </option>
                                    <option value="B"> B </option>
                                    <option value="C"> C </option>
                                    <option value="D"> D </option>
                                    <option value="E"> E </option>
                                    <option value="AB"> AB </option>
                                    <option value="AC"> AC </option>
                                    <option value="AD"> AD </option>
                                    <option value="AE"> AE </option>
								</select>
							</div>

							<div class="form-group col-md-2 col-sm-2 col-xs-12 ">
								<label class="control-label" for="validade_cnh">Validade</label>
								<input type="text" id="validade_cnh" 	class="form-control datas_input" name="validade_cnh" v-mask="'##/##/####'">
							</div>
						</div>

						<div class="form-group row">
							<div class="form-group col-md-9 col-sm-9 col-xs-12">
								<label class="control-label" for="cargo_id">Cargo</label>
								<select name = "cargo_id" id="cargo_id" class="form-control  selectpicker error" 
									data-style="select-with-transition has-dourado" required>
									<option value=""> </option>
									@foreach ($cargos as $cargo)
										<option value="{{$cargo->id}}"> {{$cargo->cargo}} </option>
									@endforeach
									
								</select>
							</div>
						</div>
						
						<div class="ln_solid"> </div>
												
						<h4 >Endereço</h4>
						<br/>
						{{-- ENDEREÇO --}}
						<div class="form-group row">
							<div class="form-group col-md-2">
								<label class="col-md-1 control-label" for="cep">CEP</label>
								<input id="cep" name="cep" type="text"  class="form-control"  v-mask="'##.###-###'" >
							</div>
							
							<div class="form-group col-md-5">
								<label class="col-md-1 control-label" for="municipio">Município</label>
								<input id="municipio" name="municipio" type="text"  class="form-control" minlength="4" maxlength="30">
							</div>
							
							<div class="form-group col-md-5">
								<label class="col-md-1 control-label" for="bairro">Bairro</label>
								<input id="bairro" name="bairro" type="text"  class="form-control" minlength="4" maxlength="30">
							</div>
						</div>

						<div class="form-group row">
							<div class="form-group col-md-6">
									<label class="col-md-1 control-label" for="logradouro">Logradouro</label>
									<input id="logradouro" name="logradouro" type="text" class="form-control" minlength="4" maxlength="100">
								</div>
						
								<div class="form-group col-md-2">
									<label class="col-md-1 control-label" for="numero">Numero</label>
									<input id="numero" name="numero" type="text" class="form-control">
								</div>
						
								<div class="form-group  col-md-4">
									<label class="col-md-1 control-label" for="complemento">Complemento</label>
									<input id="complemento" name="complemento" type="text" class="form-control" maxlength="100">
								</div>
						</div>
						<div class="form-group row">
							<div class="form-group col-md-3 col-sm-3 col-xs-12 ">
								<label class="control-label" for="telefone1">Telefone 1</label>
								<input type="text" id="telefone1" class="form-control" name="telefone1" 
									minlength="9" maxlength="15" v-mask="['(##) ####-####', '(##) #####-####']">		
							</div>
						
							<div class="form-group col-md-3 col-sm-3 col-xs-12 ">
								<label class="control-label" for="telefone2">Telefone 2</label>
								<input type="text" id="telefone2" class="form-control" name="telefone2" 
									minlength="9" maxlength="15" v-mask="['(##) ####-####', '(##) #####-####']" >		
							</div>
						
							<div class="form-group col-md-3 col-sm-3 col-xs-12 ">
								<label class="control-label" for="telefone3">Telefone 3</label>
								<input type="text" id="telefone3" class="form-control" name="telefone3" 
									minlength="9" maxlength="15" v-mask="['(##) ####-####', '(##) #####-####']">		
							</div>
						</div>
						
						<div class="ln_solid"> </div>


						
						<h4 >Antropométricos</h4>
						<br/>
						<div class="form-group row">
							<div class=" form-group col-md-2 col-sm-2 col-xs-12">
								<label class="control-label" >Altura</label>
								<input type="number" id="altura" class="form-control dois_digitos" name="altura" minlength="1" maxlength="3"  step="0.01">	
							</div>
			
							<div class=" form-group col-md-2 col-sm-2 col-xs-12">
								<label class="control-label" >Peso</label>
								<input type="number" id="peso" class="form-control dois_digitos" name="peso" minlength="40" maxlength="200" step="0.01">	
							</div>
			
							<div class=" form-group col-md-2 col-sm-2 col-xs-12">
								<label class="control-label" >Calça</label>
								<input type="number" id="calca" class="form-control" name="calca" step="1">	
							</div>
			
							<div class=" form-group col-md-2 col-sm-2 col-xs-12">
								<label class="control-label" >Sapato</label>
								<input type="number" id="sapato" class="form-control" name="sapato" step="1">	
							</div>
							
							<div class=" form-group col-md-2 col-sm-2 col-xs-12">
								<label class="control-label" >Tênis</label>
								<input type="number" id="tenis" class="form-control" name="tenis" step="1">	
							</div>
							
							<div class=" form-group col-md-2 col-sm-2 col-xs-12">
								<label class="control-label" >Coturno</label>
								<input type="number" id="coturno" class="form-control" name="coturno" step="1">	
							</div>
							
							<div class=" form-group col-md-2 col-sm-2 col-xs-12">
								<label class="control-label" >Camisa</label>
								{{-- <input type="text" id="camisa" class="form-control" name="camisa" minlength="1" maxlength="3">	 --}}
                                <select name="camisa" id="camisa" class="form-control  selectpicker error" 
									data-style="select-with-transition has-dourado">
									<option value=""></option>
                                    <option value="PP"> PP </option>
                                    <option value="P"> P </option>
                                    <option value="M"> M </option>
                                    <option value="G"> G </option>
                                    <option value="GG"> GG </option>
                                    <option value="XGG"> XGG </option>
								</select>
							</div>
							
							<div class=" form-group col-md-2 col-sm-2 col-xs-12">
								<label class="control-label" >Colete</label>
								{{-- <input type="text" id="colete" class="form-control" name="colete" minlength="1" maxlength="3">	 --}}
                                <select name="colete" id="colete" class="form-control  selectpicker error" 
									data-style="select-with-transition has-dourado">
									<option value=""></option>
                                    <option value="PP"> PP </option>
                                    <option value="P"> P </option>
                                    <option value="M"> M </option>
                                    <option value="G"> G </option>
                                    <option value="GG"> GG </option>
                                    <option value="XGG"> XGG </option>
								</select>
							</div>

							<div class=" form-group col-md-3 col-sm-3 col-xs-12">
								<label class="control-label" >IMC</label>
								<input type="text" id="imc" class="form-control" name="imc" value="" disabled>	
							</div>
						</div>


						<div class="ln_solid"> </div>

						<div class="form-group row">
							<div class="form-group col-md-12 col-sm-12 col-xs-12 ">
								<label class="control-label" for="obs">Observação</label>
								<textarea rows="4" cols="50" id="obs" class="form-control" 
									name="obs"> </textarea>
							</div>
						</div>
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
	<script src="{{ asset('js/vanillaMasker.min.js')}}"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			//botão de voltar
			$("#btn_cancelar").click(function(){
				event.preventDefault();
				window.location.href = "{{ URL::route('agente.index') }}"; 
			});
		});
	</script>
	<script>
		const wrapper = document.querySelector(".wrapper");
		const fileName = document.querySelector(".file-name");
		const defaultBtn = document.querySelector("#default-btn");
		const customBtn = document.querySelector("#custom-btn");
		const cancelBtn = document.querySelector("#cancel-btn i");
		const img = document.querySelector(".img");
		let regExp = /[0-9a-zA-Z\^\&\'\@\{\}\[\]\,\$\=\!\-\#\(\)\.\%\+\~\_ ]+$/;
		function defaultBtnActive(){
		defaultBtn.click();
		event.preventDefault();
		}
		defaultBtn.addEventListener("change", function(){
		const file = this.files[0];
		if(file){
			const reader = new FileReader();
			reader.onload = function(){
			const result = reader.result;
			img.src = result;
			wrapper.classList.add("active");
			}
			cancelBtn.addEventListener("click", function(){
			img.src = "";
			wrapper.classList.remove("active");
			})
			reader.readAsDataURL(file);
		}
		if(this.value){
			let valueStore = this.value.match(regExp);
			fileName.textContent = valueStore;
		}
		});
	</script>
	<script>
		VMasker($("#cpf")).maskPattern("999.999.999-99");
		VMasker($("#matricula")).maskPattern("999.999");
		VMasker($("#cep")).maskPattern("99.999-999");
		VMasker($("#telefone1")).maskPattern("(99)99999-9999");
		VMasker($("#telefone2")).maskPattern("(99)99999-9999");
		VMasker($("#telefone3")).maskPattern("(99)99999-9999");
	</script>
@endpush


