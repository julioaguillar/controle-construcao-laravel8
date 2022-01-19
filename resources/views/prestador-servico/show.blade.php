@extends('templates.dashboard')

@section('titulo', 'Prestador de serviço')

@section('conteudo')
    <div class="col-xl-8 col-lg-10">
        <div class="row g-3">
            <div class="col-xl-6 col-lg-6">
                <label for="cnpj" class="form-label">CPNJ</label>
                <input type="text" class="form-control" id="cnpj" value="{{ $prestador_servico->cnpj }}" disabled>
            </div>
            <div class="col-xl-6 col-lg-6">
                <label for="cpf" class="form-label">CPF</label>
                <input type="text" class="form-control" id="cpf" value="{{ $prestador_servico->cpf }}" disabled>
            </div>
            <div class="col-12">
                <label for="nome" class="form-label">Nome Empresarial</label>
                <input type="text" class="form-control" id="nome" value="{{ $prestador_servico->nome }}" disabled>
            </div>
            <div class="col-12">
                <label for="endereco" class="form-label">Endereço</label>
                <input type="text" class="form-control" id="endereco" value="{{ $prestador_servico->endereco }}" disabled>
            </div>
            <div class="col-xl-3 col-lg-6">
                <label for="telefone" class="form-label">Telefone</label>
                <input type="text" class="form-control" id="telefone" value="{{ $prestador_servico->telefone }}" disabled>
            </div>
            <div class="col-xl-3 col-lg-6">
                <label for="celular" class="form-label">Celular</label>
                <input type="text" class="form-control" id="celular" value="{{ $prestador_servico->celular }}" disabled>
            </div>
            <div class="col-xl-6">
                <label for="contato" class="form-label">Contato</label>
                <input type="text" class="form-control" id="contato" value="{{ $prestador_servico->contato }}" disabled>
            </div>
            <div class="col-12">
                <label for="email" class="form-label">E-mail</label>
                <input type="text" class="form-control" id="email" value="{{ $prestador_servico->email }}" disabled>
            </div>
        </div>
        <hr class="my-4">
        <a class="btn btn-primary" href="{{ url()->previous() }}" role="button">Retornar</a>
    </div>
@stop
