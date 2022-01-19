@extends('templates.dashboard')

@section('titulo', 'Cadastrar Produto')

@section('conteudo')
    <div class="col-xl-8 col-lg-10">
        <form action="{{ route('produto.store') }}" method="post">
            @csrf
            <div class="row g-3">
                <div class="col-xl-6 col-lg-6">
                    <label for="codigo" class="form-label">Código</label>
                    <input type="text" class="form-control @error('codigo') is-invalid @enderror" id="codigo" name="codigo" value="{{ old('codigo') }}" autofocus>
                    @error('codigo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-xl-6 col-lg-6">
                    <label for="gtin" class="form-label">GTIN</label>
                    <input type="text" class="form-control @error('gtin') is-invalid @enderror" id="gtin" name="gtin" value="{{ old('gtin') }}">
                    @error('gtin')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-12">
                    <label for="descricao" class="form-label">Descrição</label>
                    <input type="text" class="form-control @error('descricao') is-invalid @enderror" id="descricao" name="descricao" value="{{ old('descricao') }}">
                    @error('descricao')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-3">
                    <label for="unidade_medida" class="form-label">Unidade de Medida</label>
                    <input type="text" class="form-control @error('unidade_medida') is-invalid @enderror" id="unidade_medida" name="unidade_medida" value="{{ old('unidade_medida') }}">
                    @error('unidade_medida')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <hr class="my-4">
            <button class="btn btn-primary" type="submit" name="salvar">Salvar</button>
            <button class="btn btn-danger" type="submit" name="cancelar">Cancelar</button>
        </form>
    </div>
@stop
