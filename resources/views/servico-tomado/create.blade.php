@extends('templates.dashboard')

@section('titulo', 'Lançamento - Serviço Tomado')

@section('conteudo')
    <div class="col-xl-8 col-lg-10">
        <form action="{{ route('servico-tomado.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row g-3">
                <div class="col-xl-3 col-lg-4">
                    <label for="data" class="form-label">Data</label>
                    <input type="date" class="form-control @error('data') is-invalid @enderror" id="data" name="data" value="{{ old('data') ? old('data') : date('Y-m-d') }}">
                    @error('data')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-12">
                    <label for="servico_id" class="form-label">Serviço</label>
                    <select class="form-select @error('servico_id') is-invalid @enderror" id="servico_id" name="servico_id">
                        <option></option>
                        @foreach ($servicos as $servico)
                            <option value="{{ $servico->id }}" @if($servico->id == old('servico_id')) selected @endif>{{ $servico->descricao }}</option>
                        @endforeach
                    </select>
                    @error('servico_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-12">
                    <label for="prestador_servico_id" class="form-label">Prestador de serviço</label>
                    <select id="prestador_servico_id" class="form-select @error('prestador_servico_id') is-invalid @enderror" id="prestador_servico_id" name="prestador_servico_id">
                        <option></option>
                        @foreach ($prestadores_servico as $prestador_servico)
                            <option value="{{ $prestador_servico->id }}" @if($prestador_servico->id == old('prestador_servico_id')) selected @endif>{{ $prestador_servico->nome }}</option>
                        @endforeach
                    </select>
                    @error('prestador_servico_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-6">
                    <label for="forma_pagamento_id" class="form-label">Forma de pagamento</label>
                    <select id="forma_pagamento_id" class="form-select @error('forma_pagamento_id') is-invalid @enderror" id="forma_pagamento_id" name="forma_pagamento_id">
                        <option></option>
                        @foreach ($formas_pagamento as $forma_pagamento)
                            <option value="{{ $forma_pagamento->id }}" @if($forma_pagamento->id == old('forma_pagamento_id')) selected @endif>{{ $forma_pagamento->descricao }}</option>
                        @endforeach
                    </select>
                    @error('forma_pagamento_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-6">
                    <label for="valor" class="form-label">Valor do serviço</label>
                    <input type="text" class="form-control money @error('valor') is-invalid @enderror" id="valor" name="valor" value="{{ old('valor') }}">
                    @error('valor')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-12">
                    <label for="pdf" class="form-label">Arquivo (pdf)</label>
                    <input type="file" accept=".pdf" class="form-control @error('pdf') is-invalid @enderror" id="pdf" name="pdf" value="Teste">
                    @error('pdf')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <hr class="my-4">
            <button class="btn btn-primary" type="submit" name="salvar">Salvar</button>
            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">Cancelar</button>
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Aonconstru</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Deseja cancelar o lançamento?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Não</button>
                            <a class="btn btn-primary" href="{{ route('servico-tomado.index') }}" role="button">Sim</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@stop
