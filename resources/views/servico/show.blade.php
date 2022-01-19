@extends('templates.dashboard')

@section('titulo', 'Serviço')

@section('conteudo')
    <div class="col-xl-8 col-lg-10">
        <div class="row g-3">
            <div class="col-12">
                <label for="descricao" class="form-label">Descrição</label>
                <input type="text" class="form-control" id="descricao" value="{{ $servico->descricao }}" disabled>
            </div>
        </div>
        <hr class="my-4">
        <a class="btn btn-primary" href="{{ url()->previous() }}" role="button">Retornar</a>
    </div>
@stop
