@extends('templates.dashboard')

@section('titulo', 'Lançamento - Serviço Tomado')

@section('conteudo')
    <div class="col-xl-8 col-lg-10">
        <div class="row g-3">
            <div class="col-xl-3 col-lg-4">
                <label for="data" class="form-label">Data</label>
                <input type="text" class="form-control" id="data" value="{{ Helper::formatDateBr($servicoTomado->data) }}" disabled>
            </div>
            <div class="col-12">
                <label for="servico" class="form-label">Serviço</label>
                <input type="text" class="form-control" id="servico" value="{{ $servicoTomado->servico->descricao }}" disabled>
            </div>
            <div class="col-12">
                <label for="prestador_servico" class="form-label">Prestador de serviço</label>
                <input type="text" class="form-control" id="prestador_servico" value="{{ $servicoTomado->prestador_servico->nome }}" disabled>
            </div>
            <div class="col-6">
                <label for="forma_pagamento" class="form-label">Forma de pagamento</label>
                <input type="text" class="form-control" id="forma_pagamento" value="{{ $servicoTomado->forma_pagamento->descricao }}" disabled>
            </div>
            <div class="col-6">
                <label for="valor" class="form-label">Valor do serviço</label>
                <input type="text" class="form-control money" id="valor" value="{{ $servicoTomado->valor }}" disabled>
            </div>
            <div class="col-12">
                <label for="pdf" class="form-label">Arquivo (pdf)</label>
                <input type="text" class="form-control" id="pdf" value="{{ $servicoTomado->nome_pdf }}" disabled>
            </div>
        </div>
        <hr class="my-4">
        <a class="btn btn-primary" href="{{ url()->previous() }}" role="button">Retornar</a>
    </div>
@stop
