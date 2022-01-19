@extends('templates.dashboard')

@section('titulo', 'Fornecedores')

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
        <a class="btn btn-primary" href="{{ route('fornecedor.create') }}" role="button">Novo Fornecedor</a>
        <form class="d-flex" action="{{ route('fornecedor.index') }}" method="GET">
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
            @foreach ($fornecedores as $fornecedor)
            <tr>
                <th scope="row">@if (!empty($fornecedor->cnpj)) {{ $fornecedor->cnpj }} @else {{ $fornecedor->cpf }} @endif </th>
                <td>{{ $fornecedor->nome }}</td>
                <td>{{ $fornecedor->telefone }}</td>
                <td>{{ $fornecedor->celular }}</td>
                <td>{{ $fornecedor->contato }}</td>
                <td>
                    <a href="{{ route('fornecedor.show', $fornecedor->id) }}" class="link-primary" alt="Visualizar item"><i data-feather="clipboard"></i></a>
                    <a href="{{ route('fornecedor.edit', $fornecedor->id) }}" class="link-primary" alt="Alterar item"><i data-feather="edit"></i></a>
                    {{-- <ahref="#"class="link-danger"alt="Excluiritem"><idata-feather="trash-2"></i></a> --}}
                    @include('fornecedor.delete', array('url'=>route('fornecedor.destroy', $fornecedor->id), 'fornecedor'=>$fornecedor))
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
{{-- $fornecedores->appends(['search'=>$search])->links() --}}
{{ $fornecedores->appends(request()->query())->links() }}
@stop
