@extends('templates.dashboard')

@section('titulo', 'Lançamento - Compra Produto/Mercadoria')

@section('conteudo')
    <div class="col-xl-8 col-lg-10">
        <form action="{{ route('compra-produto.store') }}" method="post" name="store" id="form-store" enctype="multipart/form-data">
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
                    <label for="fornecedor_id" class="form-label">Fornecedor</label>
                    <select id="fornecedor_id" class="form-select @error('fornecedor_id') is-invalid @enderror" id="fornecedor_id" name="fornecedor_id">
                        <option></option>
                        @foreach ($fornecedores as $fornecedor)
                            <option value="{{ $fornecedor->id }}" @if($fornecedor->id == old('fornecedor_id')) selected @endif>{{ $fornecedor->nome }}</option>
                        @endforeach
                    </select>
                    @error('fornecedor_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-xl-5">
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
                <div class="col-xl-7">
                    <label for="pdf" class="form-label">Arquivo (pdf)</label>
                    <input type="file" accept=".pdf" class="form-control @error('pdf') is-invalid @enderror" id="pdf" name="pdf">
                    @error('pdf')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-12">
                    <label class="form-label">Produtos</label>
                    <div class="table-responsive">
                        <table class="table table-hover table-striped table-sm" id="table-itens">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col">GTIN/Código</th>
                                    <th scope="col">Produto/Mercadoria</th>
                                    <th scope="col" class="text-center">Valor $</th>
                                    <th scope="col" class="text-center">Quantidade</th>
                                    <th scope="col" class="text-center">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $count_itens = 0;
                                    $total_qtde  = 0.0;
                                    $total_itens = 0.00;
                                ?>
                                @foreach ($compra_produto_itens as $item)
                                <tr>
                                    <th class="date" scope="row">{{ $item->produto->codigo }}</th>
                                    <th>{{ $item->produto->descricao }}</th>
                                    <th class="text-right">{{ $item->valor }}</th>
                                    <th class="text-right">{{ $item->quantidade }}</th>
                                    <th class="text-right">{{ $item->total }}</th>
                                </tr>
                                <?php
                                    $count_itens++;
                                    $total_qtde += $item->quantidade;
                                    $total_itens += $item->total;
                                ?>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <td colspan="2">Quantidade de registros: {{ $count_itens }}</td>
                                <th class="text-right">VALOR TOTAL</th>
                                <th class="text-right">{{ Helper::valToBR($total_qtde) }}</th>
                                <th class="text-right">{{ Helper::valToBR($total_itens) }}</th>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            @include('compra-produto.add-item')
            <div class="col-12">
                <input type="hidden" name="itens_erro" id="itens_erro" class="form-control is-invalid">
                @error('itens_erro')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
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
                            <button class="btn btn-primary" type="submit" name="cancelar">Sim</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@stop

@section('script')
    <script>

        function numberToReal(numero) {
            var numero = numero.toFixed(2).split('.');
            numero[0] = numero[0].split(/(?=(?:...)*$)/).join('.');
            return numero.join(',');
        }

        function SomaTotal() {

            let total = 0.0;

            let valor = document.getElementById('valor').value;
            let qtde = document.getElementById('quantidade').value;

            if ( ( (valor != null) && (valor != '') ) && ( (qtde != null) && (qtde != '') ) ) {

                valor = valor.replace(".", "");
                valor = valor.replace(",", ".");

                qtde = qtde.replace(".", "");
                qtde = qtde.replace(",", ".");

                try {
                    total = valor * qtde;
                } catch (e) { }

            }

            let resultado = document.getElementById('total');
            resultado.value = numberToReal(total);

        }

        function addItemClick()
        {

            // valida os dados
            let produto_id = document.getElementById('produto_id');
            let valor = document.getElementById('valor');
            let quantidade = document.getElementById('quantidade');
            let total = document.getElementById('total');

            produto_id.className = "form-select";
            valor.className = " form-control";
            quantidade.className = " form-control";

            if (
                    ( produto_id.value == null ) || ( produto_id.value === '' ) ||
                    ( valor.value == null ) || ( valor.value === '' ) ||
                    ( quantidade.value == null ) || ( quantidade.value === '' )
            ) {

                if ( ( produto_id.value === null ) || ( produto_id.value === '' ) ) {
                    produto_id.className += " is-invalid";
                }

                if ( ( valor.value === null ) || ( valor.value === '' ) ) {
                    valor.className += " is-invalid";
                }

                if ( ( quantidade.value === null ) || ( quantidade.value === '' ) ) {
                    quantidade.className += " is-invalid";
                }

                return;

            }

            document.getElementById("form-store").submit();

        }

    </script>
@stop
