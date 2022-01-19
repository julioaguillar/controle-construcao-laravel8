@extends('templates.dashboard')

@section('titulo', 'Produto')

@section('conteudo')
    <div class="col-xl-8 col-lg-10">
        <div class="row g-3">
            <div class="col-xl-6 col-lg-6">
                <label for="codigo" class="form-label">Código</label>
                <input type="text" class="form-control" id="codigo" value="{{ $produto->codigo }}" disabled>
            </div>
            <div class="col-xl-6 col-lg-6">
                <label for="gtin" class="form-label">GTIN</label>
                <input type="text" class="form-control" id="gtin" value="{{ $produto->gtin }}" disabled>
            </div>
            <div class="col-12">
                <label for="descricao" class="form-label">Descrição</label>
                <input type="text" class="form-control" id="descricao" value="{{ $produto->descricao }}" disabled>
            </div>
            <div class="col-12">
                <label for="unidade_medida" class="form-label">Unidade de Medida</label>
                <input type="text" class="form-control" id="unidade_medida" value="{{ $produto->unidade_medida }}" disabled>
            </div>
        </div>
        <hr class="my-4">
        <a class="btn btn-primary" href="{{ url()->previous() }}" role="button">Retornar</a>
    </div>
@stop
