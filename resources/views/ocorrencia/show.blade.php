@extends('gentelella.layouts.app')

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


@endpush