@extends('templates.dashboard')

@section('titulo')
Cadastro da Obra
@stop

@section('conteudo')
    <div class="col-xl-8 col-lg-10">
        <form action="{{ route('obra.update', $obra->id) }}" method="post">
            @method('PUT')
            @csrf
            <div class="row g-3">
                <div class="col-12">
                    <label for="proprietario" class="form-label">Proprietário</label>
                    <input type="text" class="form-control @error('proprietario') is-invalid @enderror" id="proprietario" name="proprietario" value="{{ old('proprietario') ? old('proprietario') : $obra->proprietario }}" autofocus>
                    @error('proprietario')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-12">
                    <label for="endereco" class="form-label">Endereço</label>
                    <input type="text" class="form-control @error('endereco') is-invalid @enderror" id="endereco" name="endereco" value="{{ old('endereco') ? old('endereco') : $obra->endereco }}">
                    @error('endereco')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-xl-3 col-lg-6">
                    <label for="inicio" class="form-label">Data Início</label>
                    <input type="date" class="form-control @error('inicio') is-invalid @enderror" id="inicio" name="inicio" value="{{ old('inicio') ? old('inicio') : $obra->inicio }}">
                    @error('inicio')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-xl-3 col-lg-6">
                    <label for="fim" class="form-label">Data prevista para término</label>
                    <input type="date" class="form-control @error('fim') is-invalid @enderror" id="fim" name="fim" value="{{ old('fim') ? old('fim') : $obra->fim }}">
                    @error('fim')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-xl-3 col-lg-6">
                    <label for="metragem" class="form-label">Metragem</label>
                    <input type="text" class="form-control money @error('metragem') is-invalid @enderror" id="metragem" name="metragem" value="{{ old('metragem') ? old('metragem') : $obra->metragem }}">
                    @error('metragem')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-xl-3 col-lg-6">
                    <label for="cub" class="form-label">CUB (Custo Unitário Básico)</label>
                    <input type="text" class="form-control money @error('cub') is-invalid @enderror" id="cub" name="cub" value="{{ old('cub') ? old('cub') : $obra->cub }}">
                    @error('cub')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <hr class="my-4">
            <button type="submit" class="btn btn-primary" name="salvar">Salvar</button>
            <span style="float: right">
            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#buttonModal">
                Obra concluída
            </button>
            </span>
            <div class="modal fade" id="buttonModal" tabindex="-1" aria-labelledby="buttonModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="buttonModalLabel">Aonconstru</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Confirma a conclusão da obra em {{ date('d/m/Y') }}?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Não</button>
                            <button type="submit" class="btn btn-primary" name="termino">Sim</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@stop
