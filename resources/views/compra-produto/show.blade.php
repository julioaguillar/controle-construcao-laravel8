@extends('templates.dashboard')

@section('titulo', 'Lançamento - Compra Produto/Mercadoria')

@section('conteudo')
    <div class="col-xl-8 col-lg-10">
        <div class="row g-3">
            <div class="col-xl-3 col-lg-4">
                <label for="data" class="form-label">Data</label>
                <input type="text" class="form-control" id="data" value="{{ Helper::formatDateBr($compraProduto->data) }}" disabled>
            </div>
            <div class="col-12">
                <label for="fornecedor" class="form-label">Fornecedor</label>
                <input type="text" class="form-control" id="fornecedor" value="@isset($compraProduto->fornecedor->nome) {{ $compraProduto->fornecedor->nome }} @endisset" disabled>
            </div>
            <div class="col-xl-5">
                <label for="forma_pagamento" class="form-label">Forma de pagamento</label>
                <input type="text" class="form-control" id="forma_pagamento" value="@isset($compraProduto->forma_pagamento->descricao) {{ $compraProduto->forma_pagamento->descricao }} @endisset" disabled>
            </div>
            <div class="col-xl-7">
                <label for="pdf" class="form-label">Arquivo (pdf)</label>
                <input type="text" class="form-control" id="pdf" value="{{ $compraProduto->nome_pdf }}" disabled>
            </div>
            <div class="col-12">
                <label class="form-label">Produtos</label>
                <div class="table-responsive">
                    <table class="table table-hover table-striped table-sm">
                        <thead class="table-light">
                            <tr>
                                <th scope="col">GTIN/Código</th>
                                <th scope="col">Produto</th>
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
                            @foreach ($compraProduto->compra_produto_itens as $item)
                            <tr>
                                <td>@if (!empty($item->produto->gtin)) {{ $item->produto->gtin }} @else {{ $item->produto->codigo }} @endif</td>
                                <td>@isset($item->produto->descricao) {{ $item->produto->descricao }} @endisset</td>
                                <td class="money text-right">{{ $item->valor }}</td>
                                <td class="money text-right">{{ $item->quantidade }}</td>
                                <td class="text-right">{{ $item->total }}</td>
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
                            <th class="text-right">TOTAL</th>
                            <th class="text-right">{{ Helper::valToBR($total_qtde) }}</th>
                            <th class="text-right">{{ Helper::valToBR($total_itens) }}</th>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        <a class="btn btn-primary" href="{{ url()->previous() }}" role="button">Retornar</a>
    </div>
@stop
