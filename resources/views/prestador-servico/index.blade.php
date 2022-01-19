@extends('templates.dashboard')

@section('titulo', 'Prestadores de serviço')

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
        <a class="btn btn-primary" href="{{ route('prestador-servico.create') }}" role="button">Novo Prestador de serviço</a>
        <form class="d-flex" action="{{ route('prestador-servico.index') }}" method="GET">
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
                <th scope="col">CNPJ/CPF</th>
                <th scope="col">Nome Empresarial</th>
                <th scope="col">Telefone</th>
                <th scope="col">Celular</th>
                <th scope="col">Contato</th>
                <th scope="col">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($prestadores_servico as $prestador_servico)
            <tr>
                <th scope="row">@if (!empty($prestador_servico->cnpj)) {{ $prestador_servico->cnpj }} @else {{ $prestador_servico->cpf }} @endif </th>
                <td>{{ $prestador_servico->nome }}</td>
                <td>{{ $prestador_servico->telefone }}</td>
                <td>{{ $prestador_servico->celular }}</td>
                <td>{{ $prestador_servico->contato }}</td>
                <td>
                    <a href="{{ route('prestador-servico.show', $prestador_servico->id) }}" class="link-primary" alt="Visualizar item"><i data-feather="clipboard"></i></a>
                    <a href="{{ route('prestador-servico.edit', $prestador_servico->id) }}" class="link-primary" alt="Alterar item"><i data-feather="edit"></i></a>
                    @include('prestador-servico.delete', array('url'=>route('prestador-servico.destroy', $prestador_servico->id), 'prestador_servico'=>$prestador_servico))
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
{{ $prestadores_servico->appends(request()->query())->links() }}
@stop
