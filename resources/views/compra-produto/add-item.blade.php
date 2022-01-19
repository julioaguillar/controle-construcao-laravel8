<div class="col-12">
    <div class="text-right">
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addItem">
            Adicionar produto/mercadoria
        </button>
    </div>
    <div class="modal fade" id="addItem" tabindex="-1" aria-labelledby="addItemLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addItemLabel">Adicionar produto/mercadoria</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <label for="produto_id" class="form-label">Produto/Mercadoria</label>
                                <select class="form-select @error('produto_id') is-invalid @enderror" id="produto_id" name="produto_id">
                                    <option></option>
                                    @foreach ($produtos as $produto)
                                    <option value="{{ $produto->id }}" @if($produto->id == old('produto_id')) selected @endif>{{ $produto->descricao }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback" id="invalid-produto-id">O campo produto/mercadoria é obrigatório.</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-4">
                                <label for="valor" class="form-label">Valor</label>
                                <input type="text" class="form-control money @error('valor') is-invalid @enderror" id="valor" name="valor" value="{{ old('valor') }}" onchange="SomaTotal();">
                                <div class="invalid-feedback" id="invalid-valor">O campo valor é obrigatório.</div>
                            </div>
                            <div class="col-xl-4">
                                <label for="quantidade" class="form-label">Quantidade</label>
                                <input type="text" class="form-control money @error('quantidade') is-invalid @enderror" id="quantidade" name="quantidade" value="{{ old('quantidade') }}" onchange="SomaTotal();">
                                <div class="invalid-feedback" id="invalid-quantidade">O campo quantidade é obrigatório.</div>
                            </div>
                            <div class="col-xl-4">
                                <label for="total" class="form-label">Total</label>
                                <input type="text" class="form-control money" id="total" name="total" value="{{ old('total') }}" readonly>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" onclick="addItemClick()">Confirmar</button>
                </div>
            </div>
        </div>
    </div>
</div>
