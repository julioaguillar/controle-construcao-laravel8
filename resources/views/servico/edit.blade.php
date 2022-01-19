@extends('templates.dashboard')

@section('titulo', 'Editar Serviço')

@section('conteudo')

    <div class="col-xl-8 col-lg-10">
        <form action="{{ route('servico.update', $servico) }}" method="post">
            @method('PUT')
            @csrf
            <div class="row g-3">
                <div class="col-12">
                    <label for="descricao" class="form-label">Descrição</label>
                    <input type="text" class="form-control @error('descricao') is-invalid @enderror" id="descricao" name="descricao" value="{{ old('descricao') ? old('descricao') : $servico->descricao }}" autofocus>
                    @error('descricao')
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
