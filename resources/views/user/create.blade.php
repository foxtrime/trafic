@extends('gentelella.layouts.app')

@section('content')

<div class="x_panel ">
    <div class="x_content">

        <div class="x_title">
            <h2> Novo Usuario </h2>
            <div class="clearfix"></div>
        </div>

        <div class="x_panel ">
            <div class="x_content">

                <form id="frm_user" class="form-horizontal form-label-left" method="post" action="{{ route('user.store')}}">
                {{ csrf_field() }}

                <div class="form-group row">
                    <label for="name" class="col-md-2 col-form-label text-md-right">Nome</label>
                    <div class="col-md-7">
                        <input id="name" type="text" class="form-control" name="name" required autofocus>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="email" class="col-md-2 col-form-label text-md-right">Email</label>
                    <div class="col-md-7">
                        <input id="email" type="email" class="form-control" name="email" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-2 col-form-label text-md-right" for="cpf">CPF</label>
                    <div class="col-md-7">
                        <input type="cpf" id="cpf" class="form-control" name="cpf" minlength="11" required>
                    </div>
                </div>


                <div class="form-group row">
                    <label for="tipo" class="col-md-2 col-form-label text-md-right">Tipo</label>
                    <div class="col-md-7">
                        <select id="tipo" class="form-control" name="tipo" required>
                            <option value="" selected>Selecione um Tipo...</option>
                            <option value="Efetivo">Efetivo</option>
                            <option value="Comissionado">Comissionado</option>
                            <option value="Externo">Externo</option>
                            
                        </select>
                    </div>
                </div>

                {{-- BOTÕES --}}
                <div class="clearfix"></div>
                <div class="ln_solid"> </div>
                    <div class="footer text-right"> {{-- col-md-3 col-md-offset-9 --}}
                        <input type="submit" hidden> {{-- INPUT HIDDEN PARA DEIXAR O BTN NA ORDEM DE SALVAR NA DIREITA --}}

                        <button id="btn_voltar" class="botoes-acao btn btn-round btn-primary">
                            <i class='fas fas-tabela fa-backspace'></i>
                            <span class="texto-botoes-acao"> CANCELAR </span>
                            <div class="ripple-container"></div>
                        </button>

                        <button type="submit" id="btn_salvar" class="botoes-acao btn btn-round btn-success ">
                            <i class="fas fas-tabela fa-save"></i>
                            <span class="texto-botoes-acao"> SALVAR </span>
                            <div class="ripple-container"></div>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>




@endsection

@push('scripts')
    <script src="{{ asset('js/vanillaMasker.min.js')}}"></script>
    <script>
        VMasker($("#cpf")).maskPattern("999.999.999-99");
    </script>
	<script type="text/javascript">
        $(document).ready(function(){
            //botão de voltar
			$("#btn_voltar").click(function(){
				event.preventDefault();
				window.location.href = "{{ URL::route('user.index') }}"; 
			});
        });
	</script>
@endpush