@extends('templates.dashboard')

@section('titulo', 'Editar Prestador de serviço')

@section('conteudo')

    <div class="col-xl-8 col-lg-10">
        <form action="{{ route('prestador-servico.update', $prestador_servico) }}" method="post">
            @method('PUT')
            @csrf
            <div class="row g-3">
                <div class="col-xl-6 col-lg-6">
                    <label for="cnpj" class="form-label">CPNJ</label>
                    <input type="text" class="form-control cnpj @error('cnpj') is-invalid @enderror" id="cnpj" name="cnpj" value="{{ old('cnpj') ? old('cnpj') : $prestador_servico->cnpj }}" autofocus>
                    @error('cnpj')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-xl-6 col-lg-6">
                    <label for="cpf" class="form-label">CPF</label>
                    <input type="text" class="form-control cpf @error('cpf') is-invalid @enderror" id="cpf" name="cpf" value="{{ old('cpf') ? old('cpf') : $prestador_servico->cpf }}">
                    @error('cpf')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-12">
                    <label for="nome" class="form-label">Nome Empresarial</label>
                    <input type="text" class="form-control @error('nome') is-invalid @enderror" id="nome" name="nome" value="{{ old('nome') ? old('nome') : $prestador_servico->nome }}">
                    @error('nome')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-12">
                    <label for="endereco" class="form-label">Endereço</label>
                    <input type="text" class="form-control @error('endereco') is-invalid @enderror" id="endereco" name="endereco" value="{{ old('endereco') ? old('endereco') : $prestador_servico->endereco }}">
                    @error('endereco')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-xl-3 col-lg-6">
                    <label for="telefone" class="form-label">Telefone</label>
                    <input type="text" class="form-control phone_with_ddd @error('telefone') is-invalid @enderror" id="telefone" name="telefone" value="{{ old('telefone') ? old('telefone') : $prestador_servico->telefone }}">
                    @error('telefone')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-xl-3 col-lg-6">
                    <label for="celular" class="form-label">Celular</label>
                    <input type="text" class="form-control cellphone_with_ddd @error('celular') is-invalid @enderror" id="celular" name="celular" value="{{ old('celular') ? old('celular') : $prestador_servico->celular }}">
                    @error('celular')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-xl-6">
                    <label for="contato" class="form-label">Contato</label>
                    <input type="text" class="form-control @error('contato') is-invalid @enderror" id="contato" name="contato" value="{{ old('contato') ? old('contato') : $prestador_servico->contato }}">
                    @error('contato')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-12">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') ? old('email') : $prestador_servico->email }}">
                    @error('email')
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
