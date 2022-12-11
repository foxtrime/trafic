@extends('gentelella.layouts.app')

@section('content')

<div class="x_panel ">
    <div class="x_content">

        <div class="x_title">
            <h2> Novo Cargo </h2>
            <div class="clearfix"></div>
        </div>

        <div class="x_panel ">
            <div class="x_content">

                <form id="frm_user" class="form-horizontal form-label-left" method="post" action="{{ route('cargo.store')}}">
                {{ csrf_field() }}

                <div class="form-group row">
                    <label for="cargo" class="col-md-2 col-form-label text-md-right">Cargo</label>
                    <div class="col-md-7">
                        <input id="cargo" type="text" class="form-control" name="cargo" required autofocus>
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
	<script type="text/javascript">
        $(document).ready(function(){
            //botão de voltar
			$("#btn_voltar").click(function(){
				event.preventDefault();
				window.location.href = "{{ URL::route('cargo.index') }}"; 
			});
        });
	</script>
@endpush