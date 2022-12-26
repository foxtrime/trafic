@extends('gentelella.layouts.app')

@section('content')
<link href="{{ asset('css/gallery.css') }}" rel="stylesheet" />

<vc_pagina>    
	<div class="x_title">
		<h2><i class="fas fa-user-shield"></i> Ocorrência Detalhada </h2>
		<div class="clearfix"></div>
	</div>
	<div class="x_panel ">
		<div class="x_content">
			<div class="row">
				<center><img src="{{url('img/logo_png.png')}}" height="250%" width="10%"/></center>
			</div>

			<div class="row">
				<h3 style="text-align:center;"><u>SECRETARIA MUNICIPAL DE TRANSPORTE E TRÂNSITO</u></h3>
			</div>

			<div class="row" style="font-size: 17px;padding-left: 80%;text-align:center">
					<td>{{ $ocorrencia->sequencia}}</td>
			</div>
			
        <div class="row" style="font-size: 17px;padding-top: 10px;">
            <div class="col-md-3 col-sm-3 col-xs-12">
               <strong>Setor:</strong> {{$ocorrencia->setor->nome}}
            </div>

            @if (isset($ocorrencia->atendimento->nome))               
               <div class="col-md-3 col-sm-3 col-xs-12">
                  <strong>Atendimento:</strong> {{$ocorrencia->atendimento->nome}}
               </div>
            @endif   
            

            @if (isset($ocorrencia->conducao->nome))
               <div class="col-md-3 col-sm-3 col-xs-12">
                  <strong>Condução:</strong> {{$ocorrencia->conducao->nome}}
               </div>
            @endif   

            
            @if (isset($ocorrencia->tipo->nome))         
               <div class="col-md-3 col-sm-3 col-xs-12">   
                  <strong>Tipo:</strong> {{$ocorrencia->tipo->nome}}
               </div>
            @endif   
            

            @if (isset($ocorrencia->clima->nome))            
               <div class="col-md-3 col-sm-3 col-xs-12">
                  <strong>Clima:</strong> {{$ocorrencia->clima->nome}}
               </div>
            @endif  
            
            @if (isset($ocorrencia->transportado->nome))
               <div class="col-md-3 col-sm-3 col-xs-12">
                  <strong>Transportado:</strong> {{$ocorrencia->transportado->nome}}
               </div>
            @endif 
		</div>
         
         <div class="row" style="font-size: 17px;padding-top: 10px;">
				<strong>Categorias:</strong> 
               @foreach ($ocorrencia->categorias as $categoria)
                {{$categoria->nome}} /
               @endforeach
			</div>
         

			<div class="row" style="font-size: 17px;padding-top: 10px;">
				<strong>Data:</strong> {{ date('d/m/Y', strtotime($ocorrencia->data)) }}
			</div>

			<div class="row" style="font-size: 17px;padding-top: 10px;">
				<strong>Hora:</strong>  {{ substr($ocorrencia->hora,0, 5) }}
			</div>

			<div class="row" style="font-size: 17px;padding-top: 10px;">
				<strong>Local:</strong> {{$ocorrencia->bairro}}@isset($ocorrencia->bairro),@endisset {{ $ocorrencia->cep }}@isset($ocorrencia->cep),@endisset {{ $ocorrencia->logradouro }}@isset($ocorrencia->logradouro),@endisset  {{ $ocorrencia->numero }} {{ $ocorrencia->complemento}}
			</div>

			<div class="row" style="font-size: 17px;padding-top: 10px;">		
				<strong>Envolvidos:</strong> {{ $ocorrencia->envolvidos }}
			</div>

			<div class="row" style="font-size: 17px;padding-top: 10px;">
				<strong>Relato Sucinto:</strong> {{ $ocorrencia->relato }}
			</div>

			<div class="row" style="font-size: 17px;padding-top: 10px;">
				<strong>Providencias Adotadas:</strong> {{ $ocorrencia->providencia }}
			</div>

			<div class="row" style="font-size: 17px;padding-top: 10px;">
				<strong>Outros Funcionarios:</strong>
					@foreach($ocorrencia->agentes()->where("relator", false)->get() as $funcionario)
						{{ $funcionario->nome_servico }} /
					@endforeach
			</div>

			<div class="row" style="font-size: 17px;padding-top: 10px;">
				<strong>Nome do Relator:</strong> 
				@if( $ocorrencia->agentes()->where("relator", true)->first() === null  )
					--
				@else
					{{ $ocorrencia->agentes()->where("relator", true)->first()->nome_servico}}
				@endif
	
			</div>
		
			<div class="row" style="font-size: 17px;padding-top: 10px;">
				<strong>Matrícula:</strong>
				@if( $ocorrencia->agentes()->where("relator", true)->first() === null  )
					--
				@else
					{{$ocorrencia->agentes()->where("relator", true)->first()->matricula}}
				@endif

				
			</div>

			<div class="row">
				@foreach ($ocorrencia->imagens as $imgs)
					<div class="form-group col-md-3 col-sm-3 col-xs-3">
						
						<img class="myImages" id="myImg" src="{{ URL("storage/ocorrencia/")."/" .$imgs->image}}" width="300" height="200"> 
	
					</div>
				@endforeach
			</div>

			<div id="myModal" class="modala">
				<span class="close">&times;</span>
				<img class="modala-content" id="img01">
				<div id="caption"></div>
			</div>

			{{-- BOTÕES --}}
			<div class="clearfix"></div>
			<div class="ln_solid"> </div>
			<div class="footer text-right"> {{-- col-md-3 col-md-offset-9 --}}
				 <button id="btn_voltar" class="botoes-acao btn btn-round btn-primary">
					  <span class="icone-botoes-acao mdi mdi-backburger"></span>
					  <span class="texto-botoes-acao"> VOLTAR </span>
					  <div class="ripple-container"></div>
				 </button>
			</div>

		</div>
	</div>

</vc_pagina>

@endsection

@push('scripts')
	<script>
		// create references to the modal...
		var modal = document.getElementById('myModal');
		// to all images -- note I'm using a class!
		var images = document.getElementsByClassName('myImages');
		// the image in the modal
		var modalImg = document.getElementById("img01");
		// and the caption in the modal
		var captionText = document.getElementById("caption");

		// Go through all of the images with our custom class
		for (var i = 0; i < images.length; i++) {
			var img = images[i];
			// and attach our click listener for this image.
			img.onclick = function(evt) {
				modal.style.display = "block";
				modalImg.src = this.src;
				captionText.innerHTML = this.alt;
			}
		}

		var span = document.getElementsByClassName("close")[0];

		span.onclick = function() {
			modal.style.display = "none";
		}

		  //botão de voltar
		  $("#btn_voltar").click(function() {
				event.preventDefault();
				window.history.back();
			});
	</script>
@endpush



{{-- @extends('gentelella.layouts.app')

@section('content')

<div class="x_panel modal-content">
    <div class="x_title">
       <h2><i class="fas fa-newspaper"></i> Ocorrência </h2>
       <ul class="nav navbar-right panel_toolbox">
       
      </ul>
      <div class="clearfix"></div>
    </div>


    <div class="x_panel">
       <div class="x_content">
      
            {{$ocorrencia->sequencia}}<br>
            {{$ocorrencia->data}}<br>
            {{$ocorrencia->hora}}<br>
            {{$ocorrencia->envolvidos}}<br>
            {{$ocorrencia->providencia}}<br>
            {{$ocorrencia->relato}}<br>
            {{$ocorrencia->setor->nome}}<br>
            {{$ocorrencia->atendimento->nome}}<br>
            {{$ocorrencia->conducao->nome}}<br>
            {{$ocorrencia->tipo->nome}}<br>
            {{$ocorrencia->clima->nome}}<br>
            {{$ocorrencia->bairro}}<br>
            {{$ocorrencia->logradouro}}<br>
    

            
            @foreach ($ocorrencia->imagens as $img)
                <img class="myImages" id="myImg" src="{{ url("storage/ocorrencia/")."/" .$img->image}}" width="300" height="200">
            @endforeach

       </div>
    </div>
 </div>

@endsection

@push('scripts')


@endpush --}}