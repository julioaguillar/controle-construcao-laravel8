@extends('templates.dashboard')

@section('titulo', 'Compras Produtos/Mercadorias')

@section('conteudo')
{{-- alert: primary, secondary, success, danger, warning, info, light e dark --}}
@if (Session::has('mensagem'))
    @if (Session::has('alert'))
        <div class="alert alert-{{ Session::get('alert') }} alert-dismissible fade show" role="alert">
            {{ Session::get('mensagem') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @else
        <div class="alert alert-secondary alert-dismissible fade show" role="alert">
            {{ Session::get('mensagem') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
@endif
<nav class="navbar navbar-light bg-light">
    <div class="container-fluid">
        <a class="btn btn-primary" href="{{ route('compra-produto.create') }}" role="button">Lançar compra produto/mercadoria</a>
        <form class="d-flex" action="{{ route('compra-produto.index') }}" method="GET">
            <input class="form-control me-2" type="search" name="search" placeholder="Digite o texto para pesquisa" aria-label="Search" style="min-width:400px;">
            <button class="btn btn-outline-success" type="submit">Pesquisar</button>
        </form>
    </div>
</nav>
<br />
<div class="table-responsive">
    <table class="table table-hover table-striped table-sm">
        <thead class="table-light">
            <tr>
                <th scope="col">Data</th>
                <th scope="col">Fornecedor</th>
                <th scope="col">Forma de Pagamento</th>
                <th scope="col" class="text-center">Total</th>
                <th scope="col" class="text-center">Arquivo</th>
                <th scope="col" class="text-center">Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $qtde_compras = 0;
                $total_compras = 0.00;
            ?>
            @foreach ($comprasProduto as $compraProduto)
            <tr>
                <th class="date" scope="row">{{ $compraProduto->dataFormatada() }}</th>
                <td>@isset($compraProduto->fornecedor->nome) {{ $compraProduto->fornecedor->nome }} @endisset</td>
                <td>@isset($compraProduto->forma_pagamento->descricao) {{ $compraProduto->forma_pagamento->descricao }} @endisset</td>
                  <td class="text-right">{{ Helper::valToBR($compraProduto->compra_produto_itens->sum('total')) }}</td>
                <td class="text-center">
                    @if($compraProduto->pdf != '')
                        <form action="{{ route('download-pdf') }}" method="POST">
                            @csrf
                            <input type="hidden" name="pdf" value="{{ $compraProduto->pdf }}">
                            <input type="hidden" name="nome_pdf" value="{{ $compraProduto->nome_pdf }}">
                            <input type="image" src="/img/pdf-icon.png" alt="{{ $compraProduto->nome_pdf }}" class="imagem_hint"/>
                        </form>
                    @endif
                </td>
                <td class="text-center">
                    <a href="{{ route('compra-produto.show', $compraProduto->id) }}" class="link-primary" alt="Visualizar item"><i data-feather="clipboard"></i></a>
                    @include('compra-produto.delete', array('url'=>route('compra-produto.destroy', $compraProduto->id), 'compraProduto'=>$compraProduto))
                </td>
            </tr>
            <?php
                $qtde_compras++;
                $total_compras += $compraProduto->compra_produto_itens->sum('total');
            ?>
            @endforeach
        </tbody>
        <tfoot>
            <td colspan="2">Quantidade de registros: {{ $qtde_compras }}</td>
            <th scope="row" class="text-right">VALOR TOTAL</th>
            <th scope="row" class="text-right">{{ Helper::valToBR($total_compras) }}</th>
            <td></td>
            <td></td>
        </tfoot>
    </table>
</div>
{{ $comprasProduto->appends(request()->query())->links() }}
@stop
