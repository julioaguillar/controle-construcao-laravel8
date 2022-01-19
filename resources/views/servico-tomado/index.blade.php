@extends('templates.dashboard')

@section('titulo', 'Serviços Tomado')

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
        <a class="btn btn-primary" href="{{ route('servico-tomado.create') }}" role="button">Lançar serviço tomado</a>
        <form class="d-flex" action="{{ route('servico-tomado.index') }}" method="GET">
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
                <th scope="col">Serviço</th>
                <th scope="col">Prestador de Serviço</th>
                <th scope="col">Forma de Pagamento</th>
                <th scope="col" class="text-center">Valor $</th>
                <th scope="col" class="text-center">Arquivo</th>
                <th scope="col" class="text-center">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($servicosTomado as $servicoTomado)
            <tr>
                <th class="date" scope="row">{{ $servicoTomado->dataFormatada() }}</th>
                <td>@isset($servicoTomado->servico->descricao) {{ $servicoTomado->servico->descricao }} @endisset</td>
                <td>@isset($servicoTomado->prestador_servico->nome) {{ $servicoTomado->prestador_servico->nome }} @endisset</td>
                <td>@isset($servicoTomado->forma_pagamento->descricao) {{ $servicoTomado->forma_pagamento->descricao }} @endisset</td>
                <td class="money text-right">{{ $servicoTomado->valor }}</td>
                <td class="text-center">
                    @if($servicoTomado->pdf != '')
                        <form action="{{ route('download-pdf') }}" method="POST">
                            @csrf
                            <input type="hidden" name="pdf" value="{{ $servicoTomado->pdf }}">
                            <input type="hidden" name="nome_pdf" value="{{ $servicoTomado->nome_pdf }}">
                            <input type="image" src="/img/pdf-icon.png" alt="{{ $servicoTomado->nome_pdf }}" class="imagem_hint"/>
                        </form>
                    @endif
                </td>
                <td class="text-center">
                    <a href="{{ route('servico-tomado.show', $servicoTomado->id) }}" class="link-primary" alt="Visualizar item"><i data-feather="clipboard"></i></a>
                    <a href="{{ route('servico-tomado.edit', $servicoTomado->id) }}" class="link-primary" alt="Alterar item"><i data-feather="edit"></i></a>
                    @include('servico-tomado.delete', array('url'=>route('servico-tomado.destroy', $servicoTomado->id), 'servicoTomado'=>$servicoTomado))
                </td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <td colspan="3">Quantidade de registros: {{ $qtde_servicos_tomado }}</td>
            <th scope="row" class="text-right">VALOR TOTAL</th>
            <th scope="row" class="text-right">{{ Helper::valToBR($total_servicos_tomado) }}</th>
            <td></td>
            <td></td>
        </tfoot>
    </table>
</div>
{{ $servicosTomado->appends(request()->query())->links() }}
@stop
