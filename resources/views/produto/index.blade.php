@extends('templates.dashboard')

@section('titulo', 'Produtos')

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
        <a class="btn btn-primary" href="{{ route('produto.create') }}" role="button">Novo Produto</a>
        <form class="d-flex" action="{{ route('produto.index') }}" method="GET">
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
                <th scope="col">Código</th>
                <th scope="col">GTIN</th>
                <th scope="col">Descrição</th>
                <th scope="col">Unidade de Medida</th>
                <th scope="col">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($produtos as $produto)
            <tr>
                <th scope="row">{{ $produto->codigo }}</th>
                <td>{{ $produto->gtin }}</td>
                <td>{{ $produto->descricao }}</td>
                <td>{{ $produto->unidade_medida }}</td>
                <td>
                    <a href="{{ route('produto.show', $produto->id) }}" class="link-primary" alt="Visualizar item"><i data-feather="clipboard"></i></a>
                    <a href="{{ route('produto.edit', $produto->id) }}" class="link-primary" alt="Alterar item"><i data-feather="edit"></i></a>
                    @include('produto.delete', array('url'=>route('produto.destroy', $produto->id), 'produto'=>$produto))
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
{{ $produtos->appends(request()->query())->links() }}
@stop
