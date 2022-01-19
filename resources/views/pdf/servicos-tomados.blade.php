@extends('pdf.cabecalho')

@section('conteudo')

    <div style="text-align: center; font-size: large">
        Serviços Tomados
    </div>

    <hr style="height:1px;border-width:0;color:rgb(50, 50, 50);background-color:black">

    <table width="100%" style="font-size: small">
        <thead>
            <tr>
                <th style="text-align: left">Data</th>
                <th style="text-align: left">Serviço</th>
                <th style="text-align: left">Prestador de Serviço</th>
                <th style="text-align: left">Forma de Pagamento</th>
                <th>Valor $</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($servicosTomado as $servicoTomado)
            <tr>
                <td style="text-align: left">{{ $servicoTomado->dataFormatada() }}</td>
                <td>@isset($servicoTomado->servico->descricao) {{ $servicoTomado->servico->descricao }} @endisset</td>
                <td>@isset($servicoTomado->prestador_servico->nome) {{ $servicoTomado->prestador_servico->nome }} @endisset</td>
                <td>@isset($servicoTomado->forma_pagamento->descricao) {{ $servicoTomado->forma_pagamento->descricao }} @endisset</td>
                <td style="text-align: right">{{ Helper::valToBR($servicoTomado->valor) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <hr style="height:1px;border-width:0;color:rgb(50, 50, 50);background-color:black">

    <table width="100%">
        <tbody>
            <tr>
                <th colspan="4" style="text-align: right">VALOR TOTAL</th>
                <th style="text-align: right">{{ Helper::valToBR($total_servicos_tomado) }}</th>
            </tr>
        </tbody>
    </table>

@stop
