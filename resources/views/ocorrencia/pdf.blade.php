<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xml:lang="en" xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />

<title>Ocorrência</title>
<style type="text/css">
@page {
	margin: 2cm;
	margin-top: 50px; 
	margin-bottom: 40px;
}
body {
    font-family: sans-serif;
    font-size:15px;
	 margin: 2.5cm 0;
	 text-align: justify;
}
#header { 
	position: fixed; 
	top: -30px; 
	left: 0px; 
	right: 0px;  
	height: 50px; }
#footer {
	position: fixed;
	left: 0;
	right: 0;
	color: #000000;
	font-size: 0.9em;
}
#footer {
  bottom: -20px;
}
#header table {
}
#footer table {
	width: 100%;
	border-collapse: collapse;
	border: none;
}
#header td {
}
#footer td {
  padding: 0;
	width: 10%;
}
.page-footer {
  text-align: center;
}
hr {
  page-break-after: always;
  border: 0;
}
table.separate {
  border-collapse: separate;
  border-spacing: 20pt;
  
}
td{
    padding: 4px;
}
.container{
	 justify-content: flex-start;
}
.semsopimagem {
  margin-top: 1cm;
  height: 260px !important;
  width: 260px !important;
}
.Imangemsemsop{
  margin-top: 1cm;
  margin: 0 auto !important;
}
.page-number {
  text-align: center;
}
.page-number:before {
  content: "Pagina " counter(page);
}
#watermark { position: fixed; bottom: 150px; width: 650px; height: 600px; opacity: .1; }
</style>
</head>

	<body>
		<div id="watermark"><img src="./img/logo_png.png" height="100%" width="100%"></div>
	
        <div id="header">
            <table>
              <tr>
                  <center><img src="./img/logo_png.png" height="250%" width="20%"/></center>
              </tr>
            </table>
        </div>
            <br>
        <div id="footer">
            <table>
                <tr>
                    <center><img src="./img/BrasaoFooter2.png"/></center>
                    <div class="page-number"></div>
                </tr>
            </table>
        </div>
        
        <h3 style="text-align:center;"><u>SECRETARIA MUNICIPAL DE TRANSPORTE E TRÂNSITO</u></h3>

        <div class="row" style="padding-left: 80%;">
            {{ $ocorrencia->sequencia}}
        </div>

            <br>

        @if (isset($ocorrencia->atendimento->nome))               
           <div class="col-md-3 col-sm-3 col-xs-12">
              <strong>Atendimento:</strong> {{$ocorrencia->atendimento->nome}}
           </div>
           <br>
        @endif   
            

        @if (isset($ocorrencia->conducao->nome))
           <div class="col-md-3 col-sm-3 col-xs-12">
              <strong>Condução:</strong> {{$ocorrencia->conducao->nome}}
           </div>
        @endif   

            <br>
        @if (isset($ocorrencia->tipo->nome))         
           <div class="col-md-3 col-sm-3 col-xs-12">   
              <strong>Tipo:</strong> {{$ocorrencia->tipo->nome}}
           </div>
           <br>
        @endif   
        

        @if (isset($ocorrencia->clima->nome))            
           <div class="col-md-3 col-sm-3 col-xs-12">
              <strong>Clima:</strong> {{$ocorrencia->clima->nome}}
           </div>
           <br>
        @endif  


        @if (isset($ocorrencia->transportado->nome))
           <div class="col-md-3 col-sm-3 col-xs-12">
              <strong>Transportado:</strong> {{$ocorrencia->transportado->nome}}
           </div>
           <br>
        @endif 

    
            <div class="container">
                <span style="font-weight:bold;">Categorias:</span>
                   @foreach ($ocorrencia->categorias as $categoria)
                    {{$categoria->nome}} /
                   @endforeach
		    </div>

            <br>
       

        <table cellpadding="5" cellspacing="0" style="width: 100%;">
            <tr>
                <td><span style="font-weight:bold;">Data:</span></td>
                <td>{{ date('d/m/Y', strtotime($ocorrencia->data)) }}</td>
                <td><span style="font-weight:bold;">Hora:</span></td>
                <td>{{ $ocorrencia->hora }}</td>
            </tr>  
    
             <tr>
                <td><span style="font-weight:bold;">Local:</span></td>
                <td>{{$ocorrencia->bairro}}@isset($ocorrencia->bairro),@endisset {{ $ocorrencia->cep }}@isset($ocorrencia->cep),@endisset {{ $ocorrencia->logradouro }}@isset($ocorrencia->logradouro),@endisset  {{ $ocorrencia->numero }} {{ $ocorrencia->complemento}}
                </td>
            </tr>
        </table>

        <br>
        <div class="container">
			<span style="font-weight:bold;">Envolvidos:</span>
		    {{ $ocorrencia->envolvidos }}
		</div>
		<br>
		
		<div class="container">
			<span style="font-weight:bold;">Relato Sucinto:</span>
		    {{ $ocorrencia->relato }}
		</div>
		<br>
		
		<div class="container">
			<span style="font-weight:bold;">Providências Adotadas:</span>
	   	    {{ $ocorrencia->providencia }}
	   </div>

        <br>
       
		<div>
			<span style="font-weight:bold;">Outros Funcionarios:</span> 
				@foreach($ocorrencia->agentes()->where("relator", false)->get() as $agentes)
					{{ $agentes->nome_servico }} /
				@endforeach
		</div>
		<br>

        <div>
			<span style="font-weight:bold;">Nome:</span>  {{ $ocorrencia->agentes()->where("relator", true)->first()->nome_servico }} 
			<span style="font-weight:bold;">Matrícula:</span> {{$ocorrencia->agentes()->where("relator", true)->first()->matricula}}
	 	</div>

         
         
         <div class="Imangemsemsop" style="padding-top: 10px">
            <br><br><br>
            @foreach($imagens as $imagem)
              <img src="{{ URL("storage/ocorrencia/")."/" .$imagem->image}}" width="300" height="200" style="padding-top: 60px; padding-left: 10px"> 
           @endforeach
   </div>
	</body>
</html>
